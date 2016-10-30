<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_calmedia_domain_model_date'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_calmedia_domain_model_date']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, date, all_day, description_short, description, location, version, end_date, diff_dates, category, sections',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, ;;1, ;;2, location, category, sections, --div--; Beschreibung, description_short, description, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'title, hidden', 'canNotCollapse' => 1),
		'2' => array('showitem' => 'date, end_date, all_day, diff_dates', 'canNotCollapse' => 1),
	),
	'columns' => array(

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
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.date',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'all_day' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.all_day',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'description_short' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.description_short',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'location' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.location',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'version' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.version',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			)
		),
		'end_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.end_date',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'diff_dates' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.diff_dates',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'category' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.category',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_calmedia_domain_model_typ',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'sections' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_db.xlf:tx_calmedia_domain_model_date.sections',
			'config' => array(
				'type' => 'select',
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
						'type' => 'popup',
						'title' => 'Edit',
						'module' => array(
								'name' => 'wizard_edit',
						),
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_calmedia_domain_model_section',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'module' => array(
								'name' => 'wizard_add',
						),
					),
				),
			),
		),
		
	),
);
