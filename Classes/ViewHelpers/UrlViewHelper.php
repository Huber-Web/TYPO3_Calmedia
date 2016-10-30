<?php
namespace PfarreNg\Calmedia\ViewHelpers;

class UrlViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	 * @param $controller string
	 * @param $action string
	 * @param $prev string
	 * @param $date PfarreNg\Calmedia\Model\Date
	 * @param $holidays array
	 * @param $key string
	 * @param $typ PfarreNg\Calmedia\Model\Typ
	 * @return string
	 */
	public function render($controller, $action, $prev, $date=null, $holidays=null, $key=null, $typ=null){
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$uriBuilder->reset();
		if($date){
			$arguments = array(
				'tx_calmedia_' . strtolower($prev) => array(
					'controller' => $controller,
					'action' => $action,
					'prev' => $prev,
					'date' => $date
			));
		}elseif($holidays){
			$arguments = array(
				'tx_calmedia_' . strtolower($prev) => array(
					'controller' => $controller,
					'action' => $action,
					'prev' => $prev,
					'holidays' => $holidays,
					'date' => $key
			));
		}elseif($typ){
			$arguments = array(
				'tx_calmedia_' . strtolower($prev) => array(
					'controller' => $controller,
					'action' => $action,
					'prev' => $prev,
					'cat' => $typ
			));
		}else{
			$arguments = array(
				'tx_calmedia_' . strtolower($prev) => array(
					'controller' => $controller,
					'action' => $action,
					'prev' => $prev
			));
		}
		$uriBuilder->setArguments($arguments);
		return $uriBuilder->build();
	}
}
?>