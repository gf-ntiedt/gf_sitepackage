<?php
defined('TYPO3') or die();

// Configure new fields:
$fields = [
    'gf_sitepackage_link' => [
        'label' => 'LLL:EXT:gf_sitepackage/Resources/Private/Language/locallang_db.xlf:pages.gf_sitepackage_link',
        'exclude' => 1,
        'config' => [
            'type' => 'link',
            'size' => 50,
            'appearance' => [
//                'browserTitle' => 'Test',
            ],
        ],
    ],
];

// Add new fields to pages:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $fields);

// Make fields visible in the TCEforms:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'pages', // Table name
    '--palette--;LLL:EXT:gf_sitepackage/Resources/Private/Language/locallang_db.xlf:pages.palette_additional;gf_sitepackage_palette_additional',
    // Field list to add
    '1', // List of specific types to add the field list to. (If empty, all type entries are affected)
    'after:target' // Insert fields before (default) or after one, or replace a field
);

// Add the new palette:
$GLOBALS['TCA']['pages']['palettes']['gf_sitepackage_palette_additional'] = [
    'showitem' => 'gf_sitepackage_link'
];

/**
 * Default PageTS for GfSitepackage
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'gf_sitepackage',
    'Configuration/TsConfig/Page/All.tsconfig',
    'Gedankenfolger Sitepackage'
);