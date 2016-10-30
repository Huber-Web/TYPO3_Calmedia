<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_calmedia_domain_model_typ'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_calmedia_domain_model_typ']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, title, color, version',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, title, color '),
	),
	'palettes' => array(
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
				'foreign_table' => 'tx_calmedia_domain_model_typ',
				'foreign_table_where' => 'AND tx_calmedia_domain_model_typ.pid=###CURRENT_PID### AND tx_calmedia_domain_model_typ.sys_language_uid IN (-1,0)',
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

		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_typ.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'color' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_typ.color',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'version' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_typ.version',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		
	),
);
