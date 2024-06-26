<?php

declare(strict_types=1);

namespace Gedankenfolger\GfSitepackage\ViewHelpers\Backend;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 *
 * Version 12.3.1
 */

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Frontend\ContentObject\Exception\ContentRenderingException;

final class TableListViewHelper extends AbstractTagBasedViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();

        $this->registerUniversalTagAttributes(); // id, class, dir, style, lang, title, accesskey and tabindex
        $this->registerArgument('record', 'mixed', 'Record', true);
        $this->registerArgument('fieldList', 'string', 'Comma separated list of fields to be displayed. If empty, only the header is shown', false, 'header');
        $this->registerArgument('labelList', 'string', 'Comma separated list of labels to be displayed (Header)', false, NULL);
        $this->registerArgument('lllList', 'string', 'Comma separated list of locallang labels to be displayed (LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header)', false, NULL);
        $this->registerArgument('tagName', 'string', 'Name of the tag', false, 'div');
        $this->registerArgument('childTagName', 'string', 'Name of the childtag', false, 'div');
        $this->registerArgument('childClass', 'string', 'Name of the childclass', false, '');
        $this->registerArgument('editClass', 'string', 'Class of edit link', false, 'btn btn-default');
    }

    public function render(): string
    {
        $record = $this->arguments['record'];
        $content = '';
        $this->tag->setTagName( $this->arguments['tagName'] );

        if( is_object($record) ){
            $record = get_object_vars($record);
        }
        if( !$this->arguments['labelList'] && !$this->arguments['lllList']){
            throw new ContentRenderingException('ERROR: You have to define one of these two arguments ( labelList / lllList )', 1711111259);
        }
        $fieldList = explode(',', $this->arguments['fieldList']);
        $labelList = ( $this->arguments['labelList'] ) ? explode(',', $this->arguments['labelList']) : NULL;
        $lllList = ( $this->arguments['lllList'] ) ? explode(',', $this->arguments['lllList']) : NULL;


        foreach ($fieldList as $index => $fieldname){
            if( $record[$fieldname] ){
                $label = $labelList[$index] ?? null;
                $lll = $lllList[$index] ?? null;

                if( $label ){
                    $content .= $this->tagBuilder( content:$label, tag:$this->arguments['childTagName'], class: $this->arguments['childClass']);
                }else{
                    $content .= $this->tagBuilder( content:$this->translate( $lll ), tag:$this->arguments['childTagName'], class: $this->arguments['childClass']);
                }
                $content .= $this->tagBuilder( content:(string)$record[$fieldname], tag:$this->arguments['childTagName'], class: $this->arguments['childClass']);



                $content .= $this->getEditLink($record['pid'], $record['uid'], $fieldname);
            }
        }

        $this->tag->setContent( $content );

        return $this->tag->render();
    }

    public function tagBuilder(string $content, string $tag = 'div', string $id = NULL, string $class = NULL, array $attributes = NULL): string
    {
        $tagBuilder = GeneralUtility::makeInstance(TagBuilder::class);

        $tagBuilder->setTagName($tag);

        if( $id ){
            $tagBuilder->addAttribute('id', $id);
        }

        if( $class ){
            $tagBuilder->addAttribute('class', $class);
        }

        if( $attributes ){
            $tagBuilder->addAttributes( $attributes );
        }

        $tagBuilder->setContent($content);

        return $tagBuilder->render();
    }

    /**
     * @param int $pid
     * @param int $uid
     * @param string $fieldname
     * @param string $table
     * @return string
     */
    public function getEditLink(int $pid, int $uid, string $fieldname, string $table = 'tt_content')
    {
        $backendUriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
        $uriParameters = [
            'edit' => [
                $table => [$uid => 'edit']
            ],
            'returnUrl' => $this->getReturnUrl($pid)
        ];
        if($fieldname){
            $uriParameters['columnsOnly'] = $fieldname;
        }
        $editLink = $backendUriBuilder->buildUriFromRoute('record_edit', $uriParameters);

        return $this->tagBuilder( content:$this->getIcon('actions-open'), tag:'a', class: 'btn btn-default', attributes: ['href' => $editLink]);
    }

    /**
     * @param int $id
     * @param string $table
     * @param string $route
     * @param string $iconidentifier
     * @return string
     */
    public function getLink(int $id, string $linktext, string $table = 'tt_content', string $route = 'web_list', string $iconidentifier = null)
    {
        $backendUriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
        $uriParameters = [
            'id' => $id,
            'table' => $table
        ];
        $link = $backendUriBuilder->buildUriFromRoute($route, $uriParameters);

        if($iconidentifier){
            return $this->tagBuilder( content:$this->getIcon($iconidentifier) . $linktext, tag:'a', class: 'btn btn-default', attributes: ['href' => $link]);
        }else{
            return $this->tagBuilder( content:$linktext, tag:'a', class: 'btn btn-default', attributes: ['href' => $link]);
        }

    }

    /**
     * @param int $id
     * @param string $route
     * @return string
     */
    public function getReturnUrl(int $id, string $route = 'web_layout')
    {
        $backendUriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
        $uriParameters = [
            'id' => $id
        ];

        $returnLink = (string)$backendUriBuilder->buildUriFromRoute($route, $uriParameters);

        return $returnLink;
    }

    /**
     * @param string $identifier
     * @param $size
     * @return mixed
     */
    public function getIcon(string $identifier, $size = \TYPO3\CMS\Core\Imaging\Icon::SIZE_SMALL)
    {
        $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
        $icon = $iconFactory->getIcon(
            $identifier,
            $size,
            ''
        );
        return $icon->render();
    }

    private function translate(string $input): string
    {
        return $this->getLanguageService()->sL($input);
    }

    private function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
