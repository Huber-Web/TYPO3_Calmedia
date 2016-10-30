<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'PfarreNg.' . $_EXTKEY,
	'Weekcal',
	array(
		'WeekCal' => 'list, show',
		'Date' => 'show',
		'Holiday' => 'show',
		
	),
	// non-cacheable actions
	array(
		'WeekCal' => 'list, show',
		'Date' => 'show',
		'Holiday' => 'show',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'PfarreNg.' . $_EXTKEY,
	'Cal',
	array(
		'Cal' => 'list, show',
		'Date' => 'show',
		'Holiday' => 'show',
		
	),
	// non-cacheable actions
	array(
		'Cal' => 'list, show',
		'Date' => 'show',
		'Holiday' => 'show',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'PfarreNg.' . $_EXTKEY,
	'Catcal',
	array(
		'CatCal' => 'list, show',
		'Date' => 'show',
		'Holiday' => 'show',
		
	),
	// non-cacheable actions
	array(
		'CatCal' => 'list, show',
		'Date' => 'show',
		'Holiday' => 'show',
		
	)
);
