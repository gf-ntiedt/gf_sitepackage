<?php

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
 */

namespace Gedankenfolger\GfSitepackage\ViewHelpers\Iframe;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
use TYPO3\CMS\Core\Utility\DebugUtility;

/**
 * Google Maps iFrame ViewHelper.
 * Generates an iframe
 *
 *
 * Examples
 * ========
 *
 * Basic Google Maps iFrame
 * ----------------
 *
 * ::
 *
 *    <gf:iframe.googleMaps address="companyname streetname streetnumber zipcode city"></gf:iframe.googleMaps>
 *    <gf:iframe.googleMaps address="My Company Bakerstreet 10 76841 London"></gf:iframe.googleMaps>
 *
 * Output::
 *
 *    <iframe loading="lazy" allowfullscreen="1" src="https://maps.google.com/maps?q=My%20Company%20Bakerstreet%2010%2076841%20London&amp;output=embed" width="600" height="400" frameborder="0"></iframe>
 *
 * Version 12.0.0
 *
 */
class GoogleMapsViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'iframe';

    protected $escapeOutput = false;

    /**
     * Arguments initialization
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('address', 'string', 'Specifies the iframe address');
        $this->registerArgument('satellite', 'bool', 'Specifies the iframe satellite mode',0);
        $this->registerArgument('zoom', 'int', 'Specifies the iframe zoom (1-19) 19 is 3d view',0);
        $this->registerUniversalTagAttributes(); // id, class, dir, style, lang, title, accesskey and tabindex
        $this->registerTagAttribute('width', 'int', 'Specifies the iframe width');
        $this->registerTagAttribute('height', 'int', 'Specifies the iframe height');
        $this->registerTagAttribute('src', 'string', 'Specifies the iframe source');
        $this->registerTagAttribute('frameborder', 'int', 'Specifies the iframe frameborder', 0,0);
        $this->registerTagAttribute('loading', 'string', 'Specifies the iframe lazy loading',0,'lazy');
        $this->registerTagAttribute('allowfullscreen', 'bool', 'Allow fullscreen mode',0,true);
    }

    /**
     * @return string Rendered phone link
     */
    public function render()
    {
        if( !$this->arguments['address'] && !$this->arguments['src'] ){
            throw new Exception('You must specifiy either address or src.', 8000000001);
        }
        $address = $this->arguments['address'];
        $satellite = $this->arguments['satellite'];
        $zoom = $this->arguments['zoom'];
        $src = $this->arguments['src'];
        $baseurl = 'https://maps.google.com/maps?q=';

        if( !$src ){
            $newurl = $baseurl . rawurlencode($address);
            $newurl .= ( $satellite ) ? '&t=k': '';
            $newurl .= ( $zoom ) ? '&z='.$zoom: '';


            $this->tag->addAttribute('src', $newurl . '&output=embed');
        }

        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}
