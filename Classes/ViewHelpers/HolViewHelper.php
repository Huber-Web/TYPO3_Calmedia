<?php
namespace PfarreNg\Calmedia\ViewHelpers;

class HolViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	 * @param $array Array
	 * @param $key DateTime
	 * @return string
	 */
	public function render($array, $key){
		if($key instanceof DateTime){
			$date = $key->getTimestamp();
			$date = mktime(0, 0, 0, date("m", $date), date("d", $date), date("Y", $date));
		}else{
			$date = $key;
		}
		return $array[$date];
	}
}
?>