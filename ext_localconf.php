<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Extcode.' . $_EXTKEY,
	'Product',
	array(
		'Product' => 'show, list, teaser',
	),
	// non-cacheable actions
	array(
	)
);
