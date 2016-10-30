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
class BackendController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	/**
	 * dateRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\DateRepository
	 * @inject
	 */
	protected $dateRepository;
	
	/**
	 * holidayRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\HolidayRepository
	 * @inject
	 */
	protected $holidayRepository;
	
	/**
	 * holidayRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\TemplateRepository
	 * @inject
	 */
	protected $templateRepository;
	
	/**
	 * typRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\TypRepository
	 * @inject
	 */
	protected $typRepository;   
	
	/**
	 * sectionRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\SectionRepository
	 * @inject
	 */
	protected $sectionRepository;   
	
	/**
	 * placeRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\PlaceRepository
	 * @inject
	 */
	protected $placeRepository;  
	
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
		$this->settings['persistence']['storagePid'] = $this->id;
		$this->view->assign('dates', $this->dateRepository->listBackendDates($this->id));
		$this->view->assign('holidays', $this->holidayRepository->listBackendHolidays($this->id));
		$this->view->assign('templates', $this->templateRepository->listBackendTemplates($this->id));
		$this->view->assign('returnUrl', rawurlencode(\TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl('web_CalmediaCalback', array('id'=> $this->id))));
		$this->view->assign('pid', $this->id);
	}
	
	/**
	 * action hidde date
	 * 
	 * @param date \PfarreNg\Calmedia\Domain\Model\Date
	 * return void
	 */
	public function hiddeDateAction(\PfarreNg\Calmedia\Domain\Model\Date $date){
		error_log('ID:'.$date);
// 		if($date->isHidden()){
// 			$date->setHidden(0);
// 		}else{
// 			$date->setHidden(1);
// 		}
// 		$this->dateRepository->update($date);
		$this->redirect('index');
	}

	/**
	 * Template CRUD
	 */
	
	/**
	 * action edit Template
	 * 
	 * @param template \PfarreNg\Calmedia\Domain\Model\Template
	 */
	public function editTemplateAction(\PfarreNg\Calmedia\Domain\Model\Template $template = null){
		$this->view->assign('template', $template);
		$this->view->assign('cat', $this->typRepository->listBackendTyps($this->id));
		$this->view->assign('sec', $this->sectionRepository->listBackendSections($this->id));
		$this->view->assign('place', $this->placeRepository->listBackendPlaces($this->id));
	}
	
	private function updateTemplate(\PfarreNg\Calmedia\Domain\Model\Template $template){
    	if($template->getUid()){
    		$this->templateRepository->update($template);
    	}else{
    		$this->templateRepository->add($template);
    	}
	}
	
	/**
	 * action update Template
	 * 
	 * @param template \PfarreNg\Calmedia\Domain\Model\Template 
	 */
	public function updateTemplateAction(\PfarreNg\Calmedia\Domain\Model\Template $template){
		$this->update($template);
		 
		$this->redirect('edit', null, null, array('template' => $template));
	}
}