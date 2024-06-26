<?php
namespace Gedankenfolger\GfSitepackage\ViewHelpers;

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

//use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class TagViewHelper extends AbstractTagBasedViewHelper
{
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes(); // id, class, dir, style, lang, title, accesskey and tabindex
        $this->registerArgument('tag', 'string', 'Tagname', FALSE, 'div');
        $this->registerArgument('innertag', 'string', 'inner Tagname', FALSE, NULL);
        $this->registerArgument('innerclass', 'string', 'inner Classname', FALSE, NULL);
        $this->registerArgument('if', 'string', 'If this is not Null', FALSE, NULL);
        $this->registerArgument('content', 'string', 'Content', FALSE, NULL);
        $this->registerArgument('attr', 'array', 'Tag attributes', FALSE);
        $this->registerTagAttribute('href', 'string', 'href', FALSE);
    }

    public function render(){
//        return DebuggerUtility::var_dump($this->arguments['if'], 'title');
        if( ( $this->hasArgument('if') && !empty( $this->arguments['if'] ) ) || !$this->hasArgument('if') ){
            $content = $this->arguments['content'] ?? $this->renderChildren();
            if ( $this->hasArgument('attr') && is_array($this->arguments['attr']) ){
                $this->tag->addAttributes($this->arguments['attr']);
            }
            if ( $this->hasArgument('href') ) {
                $this->tag->setTagName('a');
            }else{
                $this->tag->setTagName($this->arguments['tag']);
            }

            if ( $this->hasArgument('innertag') ) {
                $innerclass = ($this->hasArgument('innerclass')) ? 'class="'.$this->arguments['innerclass'].'"' : '';
                $tagBuilder = clone $this->tag;
                $tagBuilder->reset();
                $tagBuilder->setTagName($this->arguments['innertag']);
                $tagBuilder->addAttribute('class', $innerclass);
                $tagBuilder->setContent($content);
                $tagBuilder->forceClosingTag(false);
                $childTag = $tagBuilder->render();
                $this->tag->setContent($childTag);
            }else{
                $this->tag->setContent($content);
            }
            return $this->tag->render();
        }
    }
}
