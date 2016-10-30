<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:typ.header',
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

		'enablecolumns' => array(

		),
		'searchFields' => 'title,color,version,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('calmedia') . 'Resources/Public/Icons/tx_calmedia_domain_model_typ.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, title, color, version',
	),
	'types' => array(
		'1' => array('showitem' => '--palettes--;;palette_title, color'),
	),
	'palettes' => array(
		'palette_title' => array('showitem' => 'title, hidden;;1', 'canNotCollapse' => 1),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
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
				'renderType' => 'selectSingle',
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
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:typ.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'color' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:typ.color',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
				    'color' => array(
				    	'title' => 'Color:',
				        'type' => 'colorbox',
				        'dim' => '16�12',
				        'tableStyle' => 'border:solid 1px black;',
				        'module' => array(
				        	'name' => 'wizard_colorpicker'	
				        ),
				        'JSopenParams' => 'height=400,width=350,status=0,menubar=0,scrollbars=1',
				    ),
				),
			),
		),
		
	),
);## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder