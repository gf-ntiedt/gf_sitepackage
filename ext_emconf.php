<?php

/**
 * Extension Manager/Repository config file for ext "gf_sitepackage".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Gedankenfolger Sitepackage',
    'description' => 'Basic sitepackage based on bootstrap',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
            'fluid_styled_content' => '12.4.0-12.4.99',
            'rte_ckeditor' => '12.4.0-12.4.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Gedankenfolger\\GfSitepackage\\' => 'Classes',
        ],
    ],
    'state' => 'beta',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Niels Tiedt',
    'author_email' => 'niels.tiedt@gedankenfolger.de',
    'author_company' => 'Gedankenfolger GmbH',
    'version' => '12.1.6',
];
