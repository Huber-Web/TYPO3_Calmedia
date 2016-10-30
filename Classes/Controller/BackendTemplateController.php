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
class BackendTemplateController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
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
     */
    public function indexAction(){
    	$this->redirect('index','Backend');
    }
	
	/**
	 * action edit Template
	 * 
	 * @param template \PfarreNg\Calmedia\Domain\Model\Template
	 */
	public function editAction(\PfarreNg\Calmedia\Domain\Model\Template $template = null){
		$this->view->assign('template', $template);
		$this->view->assign('cat', $this->typRepository->listBackendTyps($this->id));
		$this->view->assign('sec', $this->sectionRepository->listBackendSections($this->id));
		$this->view->assign('place', $this->placeRepository->listBackendPlaces($this->id));
	}
	
	private function update(\PfarreNg\Calmedia\Domain\Model\Template $template){
		$template->setPid($this->id);
		
    	if($template->getUid()){
    		$this->templateRepository->update($template);
    	}else{
    		$this->templateRepository->add($template);
    	}
    	
    	$this->persistenceManager->persistAll();
	}
	
	/**
	 * action update Template
	 * 
	 * @param template \PfarreNg\Calmedia\Domain\Model\Template 
	 */
	public function updateAction(\PfarreNg\Calmedia\Domain\Model\Template $template){
		$this->update($template);
		 
		$this->redirect('edit', null, null, array('template' => $template));
	}
	
	/**
	 * action update Close Template
	 * 
	 * @param template \PfarreNg\Calmedia\Domain\Model\Template 
	 */
	public function updateCloseAction(\PfarreNg\Calmedia\Domain\Model\Template $template){
		$this->update($template);
		 
		$this->redirect('index', 'Backend');
	}
	
	/**
	 * action update New Template
	 * 
	 * @param template \PfarreNg\Calmedia\Domain\Model\Template 
	 */
	public function updateNewAction(\PfarreNg\Calmedia\Domain\Model\Template $template){
		$this->update($template);
		 
		$this->redirect('edit', null, null, array('template' => null));
	}
	
	/**
     * action delete template
     *
     * @param object \PfarreNg\Calmedia\Domain\Model\Template
     * return void
     */
    public function deleteAction(\PfarreNg\Calmedia\Domain\Model\Template $object){
    	$this->templateRepository->remove($object);
    	$this->redirect('index');
    }
}