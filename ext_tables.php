<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'PfarreNg.' . $_EXTKEY,
	'Weekcal',
	'Wochenkalender'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'PfarreNg.' . $_EXTKEY,
	'Cal',
	'Übersichtskalender'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'PfarreNg.' . $_EXTKEY,
	'Catcal',
	'Kategoriekalender'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'PfarreNg.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'calback',	// Submodule key
		'',						// Position
		array(
			'Backend' => 'index',
			'BackendDate' => 'index, export, getTemplate, copyDate, clean',
			'BackendTemplate' => 'index',
			'BackendPlace' => 'index',
			'BackendSection' => 'index',
			'BackendTyp' => 'index',
			'BackendHolidayTemplate' => 'index, generateHolidays',
			
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_backend.xlf'
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Calender Medien');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_calmedia_domain_model_date', 'EXT:calmedia/Resources/Private/Language/locallang_csh_tx_calmedia_domain_model_date.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_calmedia_domain_model_date');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_calmedia_domain_model_typ', 'EXT:calmedia/Resources/Private/Language/locallang_csh_tx_calmedia_domain_model_typ.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_calmedia_domain_model_typ');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_calmedia_domain_model_section', 'EXT:calmedia/Resources/Private/Language/locallang_csh_tx_calmedia_domain_model_section.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_calmedia_domain_model_section');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_calmedia_domain_model_holiday', 'EXT:calmedia/Resources/Private/Language/locallang_csh_tx_calmedia_domain_model_holiday.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_calmedia_domain_model_holiday');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_calmedia_domain_model_template', 'EXT:calmedia/Resources/Private/Language/locallang_csh_tx_calmedia_domain_model_template.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_calmedia_domain_model_template');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_calmedia_domain_model_place', 'EXT:calmedia/Resources/Private/Language/locallang_csh_tx_calmedia_domain_model_place.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_calmedia_domain_model_place');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_calmedia_domain_model_holidaytemplate', 'EXT:calmedia/Resources/Private/Language/locallang_csh_tx_calmedia_domain_model_holidaytemplate.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_calmedia_domain_model_holidaytemplate');
