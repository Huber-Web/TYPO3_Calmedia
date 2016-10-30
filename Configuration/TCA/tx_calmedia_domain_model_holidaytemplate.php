<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.header',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
			
		'requestUpdate' => 'reference',

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,reference,days_to_eastern,month,day,week_at_month,day_at_week,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('calmedia') . 'Resources/Public/Icons/tx_calmedia_domain_model_holiday.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, reference, days_to_eastern, month, day, week_at_month, day_at_week',
	),
	'types' => array(
		'1' => array('showitem' => 'name, reference, month, --palette--;;palette_date, --palette--;;palette_month, --palette--;;palette_eastern'),
	),
	'palettes' => array(
		'palette_eastern' => array('showitem' => 'days_to_eastern'),
		'palette_date' => array('showitem' => 'day'),
		'palette_month' => array('showitem' => 'day_at_week, week_at_month')
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
				'foreign_table' => 'tx_calmedia_domain_model_holidaytemplate',
				'foreign_table_where' => 'AND tx_calmedia_domain_model_holidaytemplate.pid=###CURRENT_PID### AND tx_calmedia_domain_model_holidaytemplate.sys_language_uid IN (-1,0)',
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

		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'reference' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.reference',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.reference.month', 'month'),
					array('LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.reference.weekMonth', 'weekMonth'),
					array('LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.reference.eastern', 'eastern'),	
				),
				'default' => 'month',
				'eval' => 'required'
			),
		),
		'days_to_eastern' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.days_to_eastern',
			'displayCond' => 'FIELD:reference:=:eastern',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'month' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.month',
			'displayCond' => array(
				'OR' => array(
						'FIELD:reference:=:month',
						'FIELD:reference:=:weekMonth'
				)	
			),
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'day' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.day',
			'displayCond' => 'FIELD:reference:=:month',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'week_at_month' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.week_at_month',
			'displayCond' => 'FIELD:reference:=:weekMonth',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'day_at_week' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:calmedia/Resources/Private/Language/locallang_basic.xlf:holidaytemplate.day_at_week',
			'displayCond' => 'FIELD:reference:=:weekMonth',
			'config' => array(
				'type' => 'select',
				'items' => array(
						array('LLL:EXT:calmedia/Resources/Private/Language/locallang.xlf:day.full.1', 0),
						array('LLL:EXT:calmedia/Resources/Private/Language/locallang.xlf:day.full.2', 1),
						array('LLL:EXT:calmedia/Resources/Private/Language/locallang.xlf:day.full.3', 2),
						array('LLL:EXT:calmedia/Resources/Private/Language/locallang.xlf:day.full.4', 3),
						array('LLL:EXT:calmedia/Resources/Private/Language/locallang.xlf:day.full.5', 4),
						array('LLL:EXT:calmedia/Resources/Private/Language/locallang.xlf:day.full.6', 5),
						array('LLL:EXT:calmedia/Resources/Private/Language/locallang.xlf:day.full.7', 6),
				),
				'default' => 0,
				'eval' => 'required'
			)
		),
		
	),
);## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder