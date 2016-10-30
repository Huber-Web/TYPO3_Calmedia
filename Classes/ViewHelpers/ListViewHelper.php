<?php
namespace PfarreNg\Calmedia\ViewHelpers;

class ListViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	 * @param $text string
	 * @return string
	 */
	public function render($text){
		return str_replace('"', '\"', $text);
	}
}
?>