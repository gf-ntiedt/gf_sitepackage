<?php

declare(strict_types=1);

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

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
//use TYPO3\CMS\Core\Utility\DebugUtility;

final class SwiperViewHelper extends AbstractTagBasedViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes(); // id, class, dir, style, lang, title, accesskey and tabindex
//        $this->registerArgument('items', 'array', 'Items to iterate', TRUE);

        $this->registerArgument('uid', 'string', 'UID', TRUE);
        $this->registerArgument('pagination', 'bool', 'Enable pagination', FALSE, false);
        $this->registerArgument('navigation', 'bool', 'Enable navigation', FALSE, false);
        $this->registerArgument('scrollbar', 'bool', 'Enable scrollbar', FALSE, false);
        $this->registerArgument('paginationclass', 'string', 'Pagination class', FALSE, 'swiper-pagination');
        $this->registerArgument('navigationprevclass', 'string', 'Navigation previous class', FALSE, 'swiper-button-prev');
        $this->registerArgument('navigationnextclass', 'string', 'Navigation next class', FALSE, 'swiper-button-next');
        $this->registerArgument('scrollbarclass', 'string', 'Scrollbar class', FALSE, 'swiper-scrollbar');
        $this->registerArgument('content', 'string', 'Content', FALSE, NULL);
        $this->registerArgument('a11y', 'array', 'Accessibility Parameters', FALSE);
        $this->registerArgument('slidesPerView', 'mixed', 'Number of slides per view (slides visible at the same time on sliders container).', FALSE, 1);
        $this->registerArgument('spaceBetween', 'mixed', 'Distance between slides in px.', FALSE, 0);
        $this->registerArgument('speed', 'int', 'Duration of transition between slides (in ms)', FALSE, 300);
        $this->registerArgument('delay', 'int', 'Delay between transitions (in ms). If this parameter is not specified, auto play will be disabled', FALSE, 3000);
        $this->registerArgument('pauseOnMouseEnter', 'bool', 'When enabled autoplay will be paused on pointer (mouse) enter over Swiper container.', FALSE, FALSE);
        $this->registerArgument('initialSlide', 'int', 'Index number of initial slide.', FALSE, 0);
        $this->registerArgument('loop', 'bool', 'Set to true to enable continuous loop mode', FALSE, FALSE);
        $this->registerArgument('lazy', 'bool', 'Lazy loading', FALSE, TRUE);
        $this->registerArgument('breakpoints', 'array', 'Allows to set different parameter for different responsive breakpoints (screen sizes).', FALSE);
    }

    public function render(): string
    {
        $content = $this->arguments['content'] ?? $this->renderChildren() ?? '';

        $output = '<div class="swiper-wrapper h-auto">' . $content . '</div>';

        if( $this->arguments['pagination'] ){
            $output .= '<div class="' . $this->arguments['paginationclass'] . '"></div>';
        }

        if( $this->arguments['navigation'] ){
            $output .= '<div class="' . $this->arguments['navigationprevclass'] . '"></div><div class="' . $this->arguments['navigationnextclass'] . '"></div>';
        }

        if( $this->arguments['scrollbar'] ){
            $output .= '<div class="' . $this->arguments['scrollbarclass'] . '"></div>';
        }

        if( !$this->arguments['class'] ){
            $this->tag->addAttribute('class', 'swiper');
        }


        $id = $this->arguments['uid'];
        $this->tag->addAttribute('id', $id);

        $this->tag->setContent( $output . $this->buildJS($id) );

        return $this->tag->render();
    }

    public function buildJS( $id ): string
    {
        $options = [
            'slidesPerView' => $this->arguments['slidesPerView'],
            'spaceBetween' => $this->arguments['spaceBetween'],
            'speed' => $this->arguments['speed'],
            'lazy' => (bool)$this->arguments['lazy'],
            'initialSlide' => $this->arguments['initialSlide'],
            'loop' => (bool)$this->arguments['loop']
        ];
        if( $this->arguments['delay'] && $this->arguments['delay'] !== 0 ){
            $options['autoplay'] = [
                'delay' => $this->arguments['delay'],
                'pauseOnMouseEnter' => (bool)$this->arguments['pauseOnMouseEnter']
            ];
        }
        if( $this->arguments['pagination'] ){
            $options['pagination'] = [
                'el' =>  '.swiper-pagination'
            ];
        }
        if( $this->arguments['navigation'] ){
            $options['navigation'] = [
                'nextEl' =>  '.swiper-button-next',
                'prevEl' =>  '.swiper-button-prev'
            ];
        }
        if( $this->arguments['scrollbar'] ){
            $options['scrollbar'] = [
                'el' =>  '.swiper-scrollbar'
            ];
        }
        if( $this->arguments['a11y'] ){
            $options['a11y'] = [];
            if( $this->arguments['a11y']['prevSlideMessage']){
                $options['a11y']['prevSlideMessage'] = $this->arguments['a11y']['prevSlideMessage'];
            }
            if( $this->arguments['a11y']['nextSlideMessage']){
                $options['a11y']['nextSlideMessage'] = $this->arguments['a11y']['nextSlideMessage'];
            }
        }
        if( $this->arguments['breakpoints'] ){
            $options['breakpoints'] = $this->arguments['breakpoints'];
        }
        $script = '';
        $script .= '<script defer="defer" type="text/javascript" id="swiper_script_' . $id . '">';
        $script .= 'function initSwiperc' . $id . '(){';
        $script .= 'const options = ' . json_encode($options) . ';';
//        $script .= 'console.log(options);';
        $script .= 'const swiper = new Swiper("#' . $id . '", options';
        $script .= ');';
        $script .= '}';
        $script .= 'window.addEventListener("DOMContentLoaded", initSwiperc' . $id . ');';
        $script .= '</script>';

        return $script;
    }
}