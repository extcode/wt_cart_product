<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$_LLL = 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf';
$_LLL_variant = $_LLL . ':tx_wtcartproduct_domain_model_variant';
$_LLL_product = $_LLL . ':tx_wtcartproduct_domain_model_product';

$GLOBALS['TCA']['tx_wtcartproduct_domain_model_variant'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_wtcartproduct_domain_model_variant']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, variant_attribute1, variant_attribute2, variant_attribute3, stock',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,
		--palette--;' . $_LLL_variant . '.palette.variants;variants,
		--div--;' . $_LLL_product . '.div.prices,
			--palette--;' . $_LLL_product . '.palette.prices;prices,
			--palette--;' . $_LLL_product . '.palette.measure;measure,
			stock,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'variants' => array('showitem' => 'variant_attribute1, variant_attribute2, variant_attribute3', 'canNotCollapse' => 1),
		'prices' => array('showitem' => 'price', 'canNotCollapse' => 1),
		'measure' => array('showitem' => 'price_measure, price_measure_unit', 'canNotCollapse' => 1),
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
				'foreign_table' => 'tx_wtcartproduct_domain_model_variant',
				'foreign_table_where' => 'AND tx_wtcartproduct_domain_model_variant.pid=###CURRENT_PID### AND tx_wtcartproduct_domain_model_variant.sys_language_uid IN (-1,0)',
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

		'variant_attribute1' => array(
			'exclude' => 0,
			'label' => $_LLL_variant . '.variant_attribute1',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_wtcartproduct_domain_model_variantattribute',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),

		'variant_attribute2' => array(
			'exclude' => 0,
			'label' => $_LLL_variant . '.variant_attribute2',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_wtcartproduct_domain_model_variantattribute',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),

		'variant_attribute3' => array(
			'exclude' => 0,
			'label' => $_LLL_variant . '.variant_attribute3',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_wtcartproduct_domain_model_variantattribute',
				'minitems' => 0,
				'maxitems' => 1,
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

		'stock' => array(
			'exclude' => 1,
			'label' => $_LLL_variant . '.stock',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'require,int'
			)
		),

		'product' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
