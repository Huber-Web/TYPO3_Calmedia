<?php
namespace PfarreNg\Calmedia\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Thomas Huber <thomas.huber@huber-web.at>, Pfarre Neuguntramsdorf
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

 /**
  * Cal Back Controller
  */
class BackendDateController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	/**
	 * dateRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\DateRepository
	 * @inject
	 */
	protected $dateRepository;
	
	/**
	 * TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;
	
	// TypoScript settings
    protected $settings = array();
    // id of selected page
    protected $id;
    // info of selected page
    protected $pageinfo;
 
    protected function initializeAction() {
        $this->id = (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
        $this->pageinfo = \TYPO3\CMS\Backend\Utility\BackendUtility::readPageAccess($this->id, $GLOBALS['BE_USER']->getPagePermsClause(1));
 
        $configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\BackendConfigurationManager');
 
        $this->settings = $configurationManager->getConfiguration(
            $this->request->getControllerExtensionName(),
            $this->request->getPluginName()
        );
    }
	
	/**
	 * action index
	 * 
	 * return void
	 */
	public function indexAction(){
		$this->redirect('index','Backend');
	}
	
	/**
	 * action get Template
	 * 
	 * @param template \PfarreNg\Calmedia\Domain\Model\Template
	 * return void
	 */
	public function getTemplateAction(\PfarreNg\Calmedia\Domain\Model\Template $template){
		$date = new \PfarreNg\Calmedia\Domain\Model\Date();
		$date->setPid($this->id);
		$date->setTitle($template->getTitle());
		$date->setDescription($template->getDescription());
		if($template->getPlace() != null)
			$date->setPlace($template->getPlace());
		$date->setLocation($template->getLocation());
		$date->setAddress($template->getAddress());
		$date->setCategory($template->getCategory());
		$date->setSections($template->getSections());
		$this->dateRepository->add($date);
		$this->persistenceManager->persistAll();
		$parameters = \TYPO3\CMS\Core\Utility\GeneralUtility::explodeUrl2Array('edit[tx_calmedia_domain_model_date]['.$date->getUid().']=edit&returnUrl='.rawurlencode(\TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl('web_CalmediaCalback', array('id'=> $this->id))));
		$this->redirectToUri(\TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl('record_edit', $parameters));
	}
	
	/**
	 * action copy Date
	 * 
	 * @param \PfarreNg\Calmedia\Domain\Model\Date $date
	 * return void
	 */
	public function copyDateAction(\PfarreNg\Calmedia\Domain\Model\Date $date){
		$nDate = new \PfarreNg\Calmedia\Domain\Model\Date();
		$nDate->setPid($this->id);
		$nDate->setTitle($date->getTitle());
		$nDate->setDescription($date->getDescription());
		if($date->getPlace() != null)
			$nDate->setPlace($date->getPlace());
		$nDate->setLocation($date->getLocation());
		$nDate->setAddress($date->getAddress());
		$nDate->setCategory($date->getCategory());
		$nDate->setSections($date->getSections());
		$this->dateRepository->add($nDate);
		$this->persistenceManager->persistAll();
		$parameters = \TYPO3\CMS\Core\Utility\GeneralUtility::explodeUrl2Array('edit[tx_calmedia_domain_model_date]['.$nDate->getUid().']=edit&returnUrl='.rawurlencode(\TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl('web_CalmediaCalback', array('id'=> $this->id))));
		$this->redirectToUri(\TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl('record_edit', $parameters));
	}
	
	/**
	 * action export
	 * 
	 * return void
	 */
	public function exportAction(){
		$excelWriter = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstanceService('PHPExcel');
		$excelObj = $excelWriter->getPHPExcel();
		
        $headers = array(
                'Pragma' => 'public',
                'Expires' => 0,
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Cache-Control' => 'public',
                'Content-Description' => 'Export CSV Date Files',
                'Content-Type' => 'text/csv;charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="cal_export.csv"',
                'Content-Transfer-Encoding' => 'binary',
        		'Content-Encoding' => 'UTF-8'
        );
   
        // send headers
        foreach ($headers as $header => $data)
            $this->response->setHeader($header, $data);
   
        $this->response->sendHeaders();
        
		$this->view->assign('dates', $this->dateRepository->listBackendDates($this->id));
	}
	
	/**
	 * action clean
	 * 
	 * return void
	 */
	public function cleanAction(){
		$cleanList = $this->dateRepository->listBackendClean($this->id);
		
		foreach ($cleanList as $date){
			$this->dateRepository->remove($date);
		}
		$this->persistenceManager->persistAll();
		
		$this->redirect('index','Backend');
	}
}