<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_wtcartproduct_domain_model_variantset'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_wtcartproduct_domain_model_variantset']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, sku, title, description, variant_attributes',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, sku, title, description;;;richtext:rte_transform[mode=ts_links], variant_attributes, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
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
				'foreign_table' => 'tx_wtcartproduct_domain_model_variantset',
				'foreign_table_where' => 'AND tx_wtcartproduct_domain_model_variantset.pid=###CURRENT_PID### AND tx_wtcartproduct_domain_model_variantset.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf:tx_wtcartproduct_domain_model_variantset.sku',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'require,trim'
			),
		),

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf:tx_wtcartproduct_domain_model_variantset.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'require,trim'
			),
		),

		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xlf:tx_wtcartproduct_domain_model_variantset.description',
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

		'variant_attributes' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wt_cart_product/Resources/Private/Language/locallang_db.xml:tx_wtcartproduct_domain_model_variantset.variantattributes',
			'config' => array(
				'type' => 'inline',
				'readOnly' => 1,
				'foreign_table' => 'tx_wtcartproduct_domain_model_variantattribute',
				'foreign_field' => 'variantset',
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

	),
);
