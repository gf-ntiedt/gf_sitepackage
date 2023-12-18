<?php
defined('TYPO3') or die('Access denied.');

// Configure new fields:
call_user_func(function() {
    $GLOBALS['TCA']['tx_mask_gf_addresses']['ctrl']['hideTable'] = false;
    $GLOBALS['TCA']['tx_mask_gf_addresses']['ctrl']['title'] = 'LLL:EXT:gf_sitepackage/Resources/Private/Language/mask.xlf:tx_mask_gf_addresses';
});
