<?php
declare(strict_types=1);

namespace Gedankenfolger\GfSitepackage\DataProcessing;

use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\Object_;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Http\RequestFactory;
//use TYPO3\CMS\Core\Log\LogManager;
//use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Core\Utility\DebugUtility;

/**
 * Data Processor for fetching data from Magento API.
 *
 * This class is responsible for fetching data from the Magento API,
 * caching the response, and adding it to the processed data array for TYPO3 frontend rendering.
 *
 *  Version 12.3.1
 *
 * @todo LogManager
 * @todo CachingFramework
 * @todo cleanup
 *
 */
class MagentoApiProcessor implements DataProcessorInterface
{
    public function __construct() {
//        $this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(__CLASS__);
    }

    /**
     * Processes the data fetched from Magento API.
     *
     * @param ContentObjectRenderer $cObj The content object renderer.
     * @param array $contentObjectConfiguration The configuration array of the content object.
     * @param array $processorConfiguration The processor configuration array.
     * @param array $processedData The processed data array.
     * @return array The processed data array with Magento API data included.
     * @throws \Exception
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
//        $cacheIdentifier = 'magento_api_data_' . sha1(json_encode($processorConfiguration));
//        $cache = GeneralUtility::makeInstance(CacheManager::class)->getCache('gedankenfolger_magento');

//        $cacheIdentifier = $processorConfiguration['cacheIdentifier'] ?? 'magento_api_data';
//        $cache = GeneralUtility::makeInstance(CacheManager::class)->getCache('gedankenfolger_magento');
//
//        $cacheIdentifier = $processorConfiguration['cacheIdentifier'] ?? 'magento_api_data';
//        try {
//            $cache = GeneralUtility::makeInstance(CacheManager::class)->getCache('gedankenfolger_magento');
//        } catch (\TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException $e) {
//            throw new \RuntimeException('Defined cache not found. Please ensure "gedankenfolger_magento" is configured.', 1630931111);
//        }

        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }

        if ( !isset( $processedData['connection'] ) && !isset( $processedData['connection'][0] )  && !isset( $processedData['connection'][0]['data'] ) ) {
            throw new \Exception('Connections not set. Please check content element configuration');
        }

        if ( !isset( $processedData['filter'] ) ) {
            throw new \Exception('Filter not set. Please check content element configuration');
        }

//        DebugUtility::debug($contentObjectConfiguration,'$contentObjectConfiguration');
//        DebugUtility::debug($processorConfiguration,'$processorConfiguration');
//        DebugUtility::debug($processedData,'$processedData');

//        try {
////            if ($cache->has($cacheIdentifier)) {
////                $apiData = $cache->get($cacheIdentifier);
////            } else {
////                $apiData = $this->fetchApiData($processorConfiguration);
////                if ($apiData !== null) {
////                    $cache->set($cacheIdentifier, $apiData, [], $processorConfiguration['cacheLifetime'] ?? 0);
////                }
////            }

            $apiData = $this->fetchApiData($processedData['connection'][0]['data'],$processedData['filter'],$processedData['data']);


//        } catch (\Exception $e) {
////            $this->>logger->error('Fetching Magento API data failed', ['exception' => $e]);
//            $apiData = null; // Consider fallback logic here
//        }
//
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'apidata');
        $processedData[$targetVariableName] = $apiData;

        return $processedData;
    }

    // Other methods (getConfigurationValue, buildApiUrl, buildSearchCriteria) remain the same

    /**
     * Fetches data from the Magento API.
     *
     * @param array $connection The API request configuration.
     * @param array $filters The API request configuration.
     * @param object $config The API request configuration.
     * @return array|null The API response data or null on failure.
     * @throws \Exception If the API request fails.
     */
    protected function fetchApiData(array $connection, array $filters, object $config): ?array {
        if(!isset($connection['host'])){
            throw new \Exception('Host not set. Please check content element configuration part connection');
        }
        if(!isset($connection['code'])){
            throw new \Exception('Store code not set. Please check content element configuration part connection');
        }
        if(!isset($connection['version'])){
            throw new \Exception('Version not set. Please check content element configuration part connection');
        }
        if(!isset($connection['endpoint'])){
            throw new \Exception('Endpoint not set. Please check content element configuration part connection');
        }
        if(!isset($connection['username'])){
            throw new \Exception('Username not set. Please check content element configuration part connection');
        }
        if(!isset($connection['password'])){
            throw new \Exception('Password not set. Please check content element configuration part connection');
        }
        if(!isset($connection['certificate'])){
            throw new \Exception('Certificate (PEM) not set. Please check content element configuration part connection');
        }

        if(!isset($config->max)){
            throw new \Exception('Max. number of products not set');
        }
        if(!isset($config->currentpage)){
            throw new \Exception('Current page of products not set');
        }
        if(!isset($config->orderby)){
            throw new \Exception('Order by field not set');
        }
        if(!isset($config->orderdirection)){
            throw new \Exception('Order direction not set');
        }


        $fullApiUrl = $this->buildApiUrl(
            $connection['host'],
            $connection['code'],
            $connection['version'],
            $connection['endpoint'],
            $filters ?? [],
            $config ?? []
        );
//        DebugUtility::debug($fullApiUrl,'$fullApiUrl');

        $certificate = GeneralUtility::getFileAbsFileName($connection["certificate"]);
        if( $certificate === '' ){
            throw new \Exception('Certificate not found. Please check path.', $connection["certificate"]);
        }

        $requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
        $additionalOptions = [
            'ssl' => [
//                'cafile' => $certificate,
                'verify_peer' => true,
                'verify_peer_name' => true,
            ],
            'auth' => [$connection['username'], $connection['password']],
            'headers' => ['Content-Type' => 'application/json'],
        ];

        $response = $requestFactory->request($fullApiUrl, 'GET', $additionalOptions);
        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents(), true);
        }

        throw new \Exception('Failed to fetch data from Magento API. Status code: ' . $response->getStatusCode());
    }

    /**
     * Builds the full API URL based on the configuration and search criteria.
     *
     * @param string $host The base URL of the API.
     * @param string $code The code of the API.
     * @param string $version The specific endpoint of the API.
     * @param string $endpoint The specific endpoint of the API.
     * @param array $filters The search criteria to be applied.
     * @param object $config The search criteria to be applied.
     * @return string The full API URL with search criteria.
     */
    protected function buildApiUrl(string $host, string $code, string $version, string $endpoint, array $filters, object $config): string {
        // <host>/rest/<store_code>/V1/products/
        $apiUrl = $host . '/rest/' . $code . '/' . $version . '/' . $endpoint . '/';
        if (!empty($filters)) {
            $apiUrl .= '?' . $this->buildSearchCriteria($filters,$config);
        }

        return $apiUrl;
    }

    /**
     * Constructs the search criteria query string from an associative array.
     *
     * @param array $criteria Array of search criteria
     * @param object $config Array of search criteria
     * @return string Search criteria query string
     */
    protected function buildSearchCriteria(array $criterias, object $config): string
    {
        // 1 => Not Visible Individually
        // 2 => Catalog
        // 3 => Search
        // 4 => Catalog, Search
        $filter = (object) [
            "search_criteria" => (object) [
//                    "filter_groups" => [
////                        0 => (object) [
////                            "filters" => [
////                                0 => (object) [
////                                    "field" => "visibility",
////                                    "value" => "4",
////                                    "condition_type" => "in"
////                                ]
////                            ]
////                        ]
//                    ],
                "sort_orders" => [
                    0 => (object) [
                        "field" => 'created_at',
                        "direction" => 'ASC'
                    ]
                ],
                "pageSize" => strval(10),
                "currentPage" => strval(1)
            ]
        ];

        if($config->conditiontype==='AND'){
            if(count($criterias)===1){
                $filter->search_criteria->filter_groups[] = (object)[
                    "filters" => [
                        0 => (object) [
                            "field" => $criterias[0]['data']['fieldname'],
                            "value" => $criterias[0]['data']['fieldvalue'],
                            "condition_type" => $criterias[0]['data']['conditiontype']
                        ]
                    ]
                ];
            }else{
                for($i=0; $i < count($criterias); $i++){
                    $filter->search_criteria->filter_groups[] = (object)[
                        "filters" => [
                            (object)[
                                "field" => $criterias[$i]['data']['fieldname'],
                                "value" => $criterias[$i]['data']['fieldvalue'],
                                "condition_type" => $criterias[$i]['data']['conditiontype']
                            ]
                        ]
                    ];
                }
            }
        }else{
            if(count($criterias)===1){
                $filter->search_criteria->filter_groups[] = (object)[
                    "filters" => [
                        0 => (object) [
                            "field" => $criterias[0]['data']['fieldname'],
                            "value" => $criterias[0]['data']['fieldvalue'],
                            "condition_type" => $criterias[0]['data']['conditiontype']
                        ]
                    ]
                ];
            }else{
                for($i=0; $i < count($criterias); $i++){
                    $tmpfilters[] = (object)[
                        "field" => $criterias[$i]['data']['fieldname'],
                        "value" => $criterias[$i]['data']['fieldvalue'],
                        "condition_type" => $criterias[$i]['data']['conditiontype']
                    ];
                }
                $filter->search_criteria->filter_groups[] = (object)[
                    "filters" => $tmpfilters
                ];
            }
        }

        return http_build_query( $filter );
    }
}
