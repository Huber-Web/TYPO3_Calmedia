<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:header',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'requestUpdate' => 'place',
		
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,date,description,location,address,end_date,category,sections,place,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('calmedia') . 'Resources/Public/Icons/tx_calmedia_domain_model_date.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, date, description, location, address, end_date, category, sections, place',
	),
	'types' => array(
		'1' => array('showitem' => '--palettes--;;palette_title, --palettes--;;palette_date, --palettes--;;palette_location, --div--;LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:tab.description, description, --div--;LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:tab.addition, category, sections, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'palette_title' => array('showitem' => 'title, hidden;;1', 'canNotCollapse' => 1),
		'palette_date' => array('showitem' => 'date, end_date, all_day', 'canNotCollapse' => 1),
		'palette_location' => array('showitem' => 'place, location, address', 'canNotCollapse' => 1),
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
				'foreign_table' => 'tx_calmedia_domain_model_date',
				'foreign_table_where' => 'AND tx_calmedia_domain_model_date.pid=###CURRENT_PID### AND tx_calmedia_domain_model_date.sys_language_uid IN (-1,0)',
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

		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:date',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 2,
				'eval' => 'trim'
			),
			'defaultExtras' => 'richtext[]'
		),
		'location' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:location',
			'displayCond' => array(
					'OR' => array(
							'FIELD:place:=:0',
							'REC:NEW:true'
					)
			),
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:address',
			'displayCond' => array(
					'OR' => array(
							'FIELD:place:=:0',
							'REC:NEW:true'
					)
			),
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'end_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:end_date',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'category' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:category',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_calmedia_domain_model_typ',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'sections' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:sections',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_calmedia_domain_model_section',
				'MM' => 'tx_calmedia_date_section_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'module' => array(
							'name' => 'wizard_edit',
						),
						'type' => 'popup',
						'title' => 'Edit',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'module' => array(
							'name' => 'wizard_add',
						),
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_calmedia_domain_model_section',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
					),
				),
			),
		),
		'place' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:place',
			'config' => array(
				'type' => 'select',
				'items' => array(array('LLL:EXT:calmedia/Resources/Private/Language/locallang_date.xlf:place.other', 0)),
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_calmedia_domain_model_place',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),		
	),
);## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder