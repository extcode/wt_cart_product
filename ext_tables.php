<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

/**
 * Get configuration from extension manager
 */
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['wt_cart_product']);

/**
 * Register Backend Modules
 */
if (TYPO3_MODE === 'BE' && !$confArr['disableBackendModule'] && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Extcode.' . $_EXTKEY,
		'web',
		'productlist',
		'',
		array(
			'Product' => 'list, show',
			'Variant' => 'list, show, edit, update',
			'VariantSet' => 'list, show',
		),
		array(
			'access' => 'user, group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xml:tx_wtcartproduct_domain_model_product',
		)
	);

}

/**
 * Register Frontend Plugins
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Extcode.' . $_EXTKEY,
	'Product',
	'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf:tx_wtcartproduct.plugin.products'
);

$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
$pluginName = strtolower('Product');
$pluginSignature = $extensionName.'_'.$pluginName;

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/Products.xml');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Shopping Cart - Products');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wtcartproduct_domain_model_product', 'EXT:wt_cart_product/Resources/Private/Language/locallang_csh_tx_wtcartproduct_domain_model_product.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wtcartproduct_domain_model_product');
$GLOBALS['TCA']['tx_wtcartproduct_domain_model_product'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf:tx_wtcartproduct_domain_model_product',
		'label' => 'sku',
		'label_alt' => 'title',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'sku,title,teaser,description,price,tax_class,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Product.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wtcartproduct_domain_model_product.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wtcartproduct_domain_model_taxclass', 'EXT:wt_cart_product/Resources/Private/Language/locallang_csh_tx_wtcartproduct_domain_model_taxclass.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wtcartproduct_domain_model_taxclass');
$GLOBALS['TCA']['tx_wtcartproduct_domain_model_taxclass'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf:tx_wtcartproduct_domain_model_taxclass',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,value,calc,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TaxClass.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wtcartproduct_domain_model_taxclass.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wtcartproduct_domain_model_variantset', 'EXT:wt_cart_product/Resources/Private/Language/locallang_csh_tx_wtcartproduct_domain_model_variantset.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wtcartproduct_domain_model_variantset');
$GLOBALS['TCA']['tx_wtcartproduct_domain_model_variantset'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf:tx_wtcartproduct_domain_model_variantset',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,value,calc,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/VariantSet.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wtcartproduct_domain_model_variantset.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wtcartproduct_domain_model_variantattribute', 'EXT:wt_cart_product/Resources/Private/Language/locallang_csh_tx_wtcartproduct_domain_model_variantattribute.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wtcartproduct_domain_model_variantattribute');
$GLOBALS['TCA']['tx_wtcartproduct_domain_model_variantattribute'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf:tx_wtcartproduct_domain_model_variantattribute',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/VariantAttribute.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wtcartproduct_domain_model_variantattribute.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wtcartproduct_domain_model_variant', 'EXT:wt_cart_product/Resources/Private/Language/locallang_csh_tx_wtcartproduct_domain_model_variant.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wtcartproduct_domain_model_variant');
$GLOBALS['TCA']['tx_wtcartproduct_domain_model_variant'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf:tx_wtcartproduct_domain_model_variant',
		'label' => 'variant_attribute1',
		'label_alt' => 'variant_attribute2,variant_attribute3',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Variant.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wtcartproduct_domain_model_variant.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
	$_EXTKEY,
	'tx_wtcartproduct_domain_model_product',
	'product_categories',
	array()
);