<?php
namespace PfarreNg\Calmedia\ViewHelpers;

class ExportViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	 * @param $text string
	 * return string
	 */
	public function render($text){
		$charset =  mb_detect_encoding($text, "UTF-8, ISO-8859-1, ISO-8859-15", true);
		
		return mb_convert_encoding($text, "UTF-8", $charset);
	}
}