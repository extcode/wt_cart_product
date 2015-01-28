<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$_EXTKEY = 'wt_cart_product';
$_LLL = 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf';
$_LLL_product = $_LLL . ':tx_wtcartproduct_domain_model_product';

$GLOBALS['TCA']['tx_wtcartproduct_domain_model_product'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_wtcartproduct_domain_model_product']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, sku, title, header_image, teaser, description, price, price_measure, price_measure_unit, base_price_measure, base_price_measure_unit, tax_class, variant_set1, variant_set2, variant_set3, variants, related_products, category',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,
		sku, title,
		--div--;' . $_LLL_product . '.div.descriptions,
			teaser;;;richtext:rte_transform[mode=ts_links], description;;;richtext:rte_transform[mode=ts_links], product_content,
		--div--;' . $_LLL_product . '.div.images_and_files,
			header_image, images, files,
		--div--;' . $_LLL_product . '.div.prices,
			--palette--;' . $_LLL_product . '.palette.prices;prices,
			--palette--;' . $_LLL_product . '.palette.measures;measures,
			stock,
		--div--;' . $_LLL_product . '.div.variants,
			--palette--;' . $_LLL_product . '.palette.variant_sets;variant_sets,
			variants, related_products,
		--div--;' . $_LLL_product . '.div.categories,
			product_categories,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'variant_sets' => array('showitem' => 'variant_set1, variant_set2, variant_set3', 'canNotCollapse' => 1),
		'prices' => array('showitem' => 'price, tax_class', 'canNotCollapse' => 1),
		'measures' => array('showitem' => 'price_measure, price_measure_unit, --linebreak--, base_price_measure, base_price_measure_unit', 'canNotCollapse' => 1),
	),
	'columns' => array(

		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_wtcartproduct_domain_model_product',
				'foreign_table_where' => 'AND tx_wtcartproduct_domain_model_product.pid=###CURRENT_PID### AND tx_wtcartproduct_domain_model_product.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'sku' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.sku',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'require,trim'
			),
		),

		'title' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'require,trim'
			),
		),

		'teaser' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.teaser',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
		),

		'description' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
		),

		'price' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.price',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'require,double2'
			)
		),

		'price_measure' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.price_measure',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double'
			)
		),

		'price_measure_unit' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.price_measure_unit',
			'config' => array(
				'type' => 'select',
				'items' => array (
					array($_LLL_product . '.measure.no_measuring_unit',0),
					array($_LLL_product . '.measure.weight', '--div--'),
					array('mg','mg'),
					array('g','g'),
					array('kg','kg'),
					array($_LLL_product . '.measure.volume', '--div--'),
					array('ml','ml'),
					array('cl','cl'),
					array('l','l'),
					array('cbm','cbm'),
					array($_LLL_product . '.measure.length', '--div--'),
					array('cm','cm'),
					array('m','m'),
					array($_LLL_product . '.measure.area'),
					array('m²','m2'),
				),
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			)
		),

		'base_price_measure' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.base_price_measure',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double'
			)
		),

		'base_price_measure_unit' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.base_price_measure_unit',
			'config' => array(
				'type' => 'select',
				'items' => array (
					array($_LLL_product . '.measure.no_measuring_unit',0),
					array($_LLL_product . '.measure.weight', '--div--'),
					array('mg','mg'),
					array('g','g'),
					array('kg','kg'),
					array($_LLL_product . '.measure.volume', '--div--'),
					array('ml','ml'),
					array('cl','cl'),
					array('l','l'),
					array('cbm','cbm'),
					array($_LLL_product . '.measure.length', '--div--'),
					array('cm','cm'),
					array('m','m'),
					array($_LLL_product . '.measure.area'),
					array('m²','m2'),
				),
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			)
		),

		'tax_class' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.tax_class',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_wtcartproduct_domain_model_taxclass',
				'foreign_field' => 'product',
				'minitems'      => 1,
				'maxitems'      => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),

		'variant_set1' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.variant_set1',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_wtcartproduct_domain_model_variantset',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),

		'variant_set2' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.variant_set2',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_wtcartproduct_domain_model_variantset',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),

		'variant_set3' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.variant_set3',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_wtcartproduct_domain_model_variantset',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),

		'variants' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.variants',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_wtcartproduct_domain_model_variant',
				'foreign_field' => 'product',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 1,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),

		'related_products' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.related_products',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_wtcartproduct_domain_model_product',
				'size' => 10,
				'minitems' => 0,
				'maxitems' => 10,
			),
		),

		'images' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.images',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
					'image',
					array(
						'appearance' => array(
							'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
						),
						'minitems' => 0,
						'maxitems' => 99,
					),
					$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
				),
		),

		'files' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.files',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
					'files',
					array(
						'appearance' => array(
							'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
						),
						'minitems' => 0,
						'maxitems' => 99,
					),
					$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
				),
		),

		'product_content' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.product_content',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tt_content',
				'foreign_field' => 'tx_wtcartproduct_domain_model_product',
				'foreign_sortby' => 'sorting',
				'minitems' => 0,
				'maxitems' => 99,
				'appearance' => array(
					'levelLinksPosition' => 'top',
					'showPossibleLocalizationRecords' => TRUE,
					'showRemovedLocalizationRecords' => TRUE,
					'showAllLocalizationLink' => TRUE,
					'showSynchronizationLink' => TRUE,
					'enabledControls' => array(
						'info' => TRUE,
						'new' => FALSE,
						'dragdrop' => FALSE,
						'sort' => FALSE,
						'hide' => TRUE,
						'delete' => TRUE,
						'localize' => TRUE,
					)
				),
				'inline' => array(
					'inlineNewButtonStyle' => 'display: inline-block;',
				),
				'behaviour' => array(
					'localizationMode' => 'select',
					'localizeChildrenAtParentLocalization' => TRUE,
				),
			)
		),

		'stock' => array(
			'exclude' => 1,
			'label' => $_LLL_product . '.stock',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'require,int'
			)
		),
	),
);

$GLOBALS['TCA']['tt_content']['columns']['tx_wtcartproduct_domain_model_product']['config']['type'] = 'passthrough';
