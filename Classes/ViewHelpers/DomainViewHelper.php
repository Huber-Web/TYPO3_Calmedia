<?php
namespace PfarreNg\Calmedia\ViewHelpers;

class DomainViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	 * @return string
	 */
	public function render(){
		return $_SERVER['HTTP_HOST'];
	}
}
?>