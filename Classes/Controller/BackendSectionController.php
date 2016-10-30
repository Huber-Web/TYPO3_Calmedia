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
class BackendSectionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {   
	
	/**
	 * sectionRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\SectionRepository
	 * @inject
	 */
	protected $sectionRepository;  
	
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
     * action section index
     *
     * return void
     */
    public function indexAction(){
    	$this->settings['persistence']['storagePid'] = $this->id;
    	$this->view->assign('sections', $this->sectionRepository->listBackendSections($this->id));
    	$this->view->assign('returnUrl', rawurlencode(\TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl('web_CalmediaCalback', array('id'=> $this->id, 'tx_calmedia_web_calmediacalback[controller]' => 'BackendSection'))));
    	$this->view->assign('pid', $this->id);
    }
    
    /**
     * action edit section
     * 
     * @param section \PfarreNg\Calmedia\Domain\Model\Section
     * return void
     */
    public function editAction(\PfarreNg\Calmedia\Domain\Model\Section $section = null){
    	$this->view->assign('section', $section);
    	$this->view->assign('pid', $this->id);
    }
    
    /**
     * central update function
     * 
     * @param section \PfarreNg\Calmedia\Domain\Model\Section
     * return void
     */
    private function update(\PfarreNg\Calmedia\Domain\Model\Section $section){
    	if($section->getUid()){
    		$this->sectionRepository->update($section);
    	}else{
    		$this->sectionRepository->add($section);
    	}
    }
    
    /**
     * action create and update section
     * 
     * @param section \PfarreNg\Calmedia\Domain\Model\Section
     * return void
     */
    public function updateAction(\PfarreNg\Calmedia\Domain\Model\Section $section){
    	$this->update($section);
    	
    	$this->redirect('edit', null, null, array('section' => $section));
    }
    
    /**
     * action create and update section
     * 
     * @param section \PfarreNg\Calmedia\Domain\Model\Section
     * return void
     */
    public function updateNewAction(\PfarreNg\Calmedia\Domain\Model\Section $section){
    	$this->update($section);
    	
    	$this->redirect('edit');
    }

    /**
     * action create and update section
     *
     * @param section \PfarreNg\Calmedia\Domain\Model\Section
     * return void
     */
    public function updateCloseAction(\PfarreNg\Calmedia\Domain\Model\Section $section){
    	$this->update($section);
    	 
    	$this->redirect('index');
    }
    
    /**
     * action delete section
     *
     * @param section \PfarreNg\Calmedia\Domain\Model\Section
     * return void
     */
    public function deleteAction(\PfarreNg\Calmedia\Domain\Model\Section $object){
    	$this->sectionRepository->remove($object);
    	$this->redirect('index');
    }
	
}