<?php
namespace Gedankenfolger\GfSitepackage\ViewHelpers\Link;

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
 * Version 0.0.1
 */

use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use TYPO3\CMS\Frontend\ContentObject\Exception\ContentRenderingException;

class UrlschemeViewHelper extends AbstractTagBasedViewHelper
{
//    protected $tagName = 'img';

    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes(); // id, class, dir, style, lang, title, accesskey and tabindex
        $this->registerArgument('number', 'string', 'Number', TRUE);
        $this->registerArgument('scheme', 'string', 'Scheme', FALSE, 'tel:');
    }

    public function render(){
        $this->tag->setTagName('a');

        $number = $this->arguments['number'];
        $regex = '/\+(\d+)\s*\(\d+\)\s*(\d+)\s*(\d+)/';

        if (preg_match($regex, $number, $matches)) {
            $formattedNumber = '+' . $matches[1] . $matches[2] . $matches[3];
        } else {
            throw new ContentRenderingException('ERROR: Invalid format', 1700485661);
        }

        $this->tag->addAttribute('href', $this->arguments['scheme'].$formattedNumber);
        $this->tag->setContent($number);

        return $this->tag->render();
    }
}
