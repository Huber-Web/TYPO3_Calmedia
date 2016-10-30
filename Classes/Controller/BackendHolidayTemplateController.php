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
class BackendHolidayTemplateController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {   
	
	/**
	 * holidayTemplateRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\HolidayTemplateRepository
	 * @inject
	 */
	protected $holidayTemplateRepository;  
	
	/**
	 * holidayRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\HolidayRepository
	 * @inject
	 */
	protected $holidayRepository;  
	
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
     * action holidayTemplate index
     *
     * return void
     */
    public function indexAction(){
    	$this->settings['persistence']['storagePid'] = $this->id;
    	$this->view->assign('holidayTemplates', $this->holidayTemplateRepository->listBackendHolidayTemplates($this->id));
    	$this->view->assign('returnUrl', rawurlencode(\TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl('web_CalmediaCalback', array('id'=> $this->id, 'tx_calmedia_web_calmediacalback[controller]' => 'BackendHolidayTemplate'))));
    	$this->view->assign('pid', $this->id);
    }
    
    /**
     * action edit holidayTemplate
     * 
     * @param holidayTemplate \PfarreNg\Calmedia\Domain\Model\HolidayTemplate
     * return void
     */
    public function editAction(\PfarreNg\Calmedia\Domain\Model\HolidayTemplate $holidayTemplate = null){
    	$this->view->assign('holidayTemplate', $holidayTemplate);
    	$this->view->assign('pid', $this->id);
    	$this->view->assign('reference', array('month' => 'Monat', 'weekMonth' => 'Wochentag', 'eastern' => 'Ostern'));
    	$this->view->assign('weekday', array(0 => 'Sonntag', 1 => 'Montag', 2 => 'Dienstag', 3 => 'Mittwoch', 4 => 'Donnerstag', 5 => 'Freitag', 6 => 'Samstag'));
    	$this->view->assign('month', array(1 => 'Jaenner', 2 => 'Februar', 3 => 'Maerz', 4 => 'April', 5 => 'Mai', 6 => 'Juni', 7 => 'Juli', 8 => 'August', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Dezember'));
    }
    
    /**
     * central update function
     * 
     * @param holidayTemplate \PfarreNg\Calmedia\Domain\Model\HolidayTemplate
     * return void
     */
    private function update(\PfarreNg\Calmedia\Domain\Model\HolidayTemplate $holidayTemplate){
    	if($holidayTemplate->getUid()){
    		$this->holidayTemplateRepository->update($holidayTemplate);
    	}else{
    		$this->holidayTemplateRepository->add($holidayTemplate);
    	}
    	
    	$this->persistenceManager->persistAll();
    }
    
    /**
     * action create and update holidayTemplate
     * 
     * @param holidayTemplate \PfarreNg\Calmedia\Domain\Model\HolidayTemplate
     * return void
     */
    public function updateAction(\PfarreNg\Calmedia\Domain\Model\HolidayTemplate $holidayTemplate){
    	$this->update($holidayTemplate);
    	
    	$this->redirect('edit', null, null, array('holidayTemplate' => $holidayTemplate));
    }
    
    /**
     * action create and update holidayTemplate
     * 
     * @param holidayTemplate \PfarreNg\Calmedia\Domain\Model\HolidayTemplate
     * return void
     */
    public function updateNewAction(\PfarreNg\Calmedia\Domain\Model\HolidayTemplate $holidayTemplate){
    	$this->update($holidayTemplate);
    	
    	$this->redirect('edit');
    }

    /**
     * action create and update holidayTemplate
     *
     * @param holidayTemplate \PfarreNg\Calmedia\Domain\Model\HolidayTemplate
     * return void
     */
    public function updateCloseAction(\PfarreNg\Calmedia\Domain\Model\HolidayTemplate $holidayTemplate){
    	$this->update($holidayTemplate);
    	 
    	$this->redirect('index');
    }
    
    /**
     * action delete holidayTemplate
     *
     * @param holidayTemplate \PfarreNg\Calmedia\Domain\Model\HolidayTemplate
     * return void
     */
    public function deleteAction(\PfarreNg\Calmedia\Domain\Model\HolidayTemplate $object){
    	$this->holidayTemplateRepository->remove($object);
    	$this->redirect('index');
    }
    
    private function createHol($template, $date){
    	if($this->holidayRepository->checkDate($this->id, $date)){
	    	$holiday = new \PfarreNg\Calmedia\Domain\Model\Holiday();
	    	$holiday->setPid($this->id);
	    	$holiday->setName($template->getName());
	    	$holiday->setDate($date);
		    $this->holidayRepository->add($holiday);
    	}
    }
    
    private function addDays($timestamp, $value, $key = 'day'){
    	$seconds = 60 * 60 * 24; //One Day
    	switch($key){
    		case 'day':
    			return $timestamp + ($value * $seconds);
    		case 'week':
    			return $timestamp + ($value * 7 * $seconds);
    	}
    }
	
    /**
     * action generateHolidays
     * 
     * @param holYear String
     * return void
     */
    public function generateHolidaysAction(){
    	$holYear = date('Y');
    	
    	for($count = 0; $count <= 1; $count++){
    		$month = $this->holidayTemplateRepository->listHolidayGen($this->id, 'month');
    		foreach($month as $template){
    			(string)$day = str_pad($template->getDay(), 2, '0', STR_PAD_LEFT);
    			(string)$month = str_pad($template->getMonth(), 2, '0', STR_PAD_LEFT);
    			$this->createHol($template, new \DateTime($holYear.'-'.$month.'-'.$day.' 00:00:00.000'));
    		}
    		
    		$weekMonth = $this->holidayTemplateRepository->listHolidayGen($this->id, 'weekMonth');
    		foreach ($weekMonth as $template){
    			(string)$month = str_pad($template->getMonth(), 2, '0', STR_PAD_LEFT);
    			$date = new \DateTime($holYear.'-'.$month.'-01 00:00:00.000');
    			$timestamp = $date->getTimestamp();
    			for($weekDay = 0; $weekDay < 7; $weekDay++){
    				if(date('w', $timestamp) == $template->getDayAtWeek()){
    					break;
    				}
    				$timestamp = $this->addDays($timestamp, 1);
    			}
    			
    			(int)$week = $template->getWeekAtMonth()-1; 
    			
    			$timestamp = $this->addDays($timestamp, $week, 'week');
    			
    			$this->createHol($template, (new \DateTime())->setTimestamp($timestamp));
    		}
    		
    		$eastern = $this->holidayTemplateRepository->listHolidayGen($this->id, 'eastern');

    		$a = $holYear % 19;
    		$b = $holYear % 4;
    		$c = $holYear % 7;
    		$m = floor(8 * floor($holYear / 100) + 13) / 25 - 2;
    		$s = floor($holYear / 100) - floor($holYear / 400) - 2;
    		$M = (15 + $s - $m) % 30;
    		$N = (6 + $s) % 7;
    		$d = ($M + 19 * $a) % 30;
    		$D = $d;
    		if($d == 29)
    			$D = 28;
    		if($d == 28 && $a >= 11)
    			$D = 27;
    		$e = (2 * $b + 4 * $c + 6 * $D + $N) % 7;
    		$date = new \DateTime($holYear . '-03-21 00:00:00.000');
    		$timestamp = $date->getTimestamp();
    		$res = $D + $e + 1;
    		
    		$timestamp = $this->addDays($timestamp, $res);
    		
    		foreach($eastern as $template){
    			$toEastern = $template->getDaysToEastern();
    			$timeRes = $this->addDays($timestamp, $toEastern);
    			$this->createHol($template, (new \DateTime())->setTimestamp($timeRes));
    		}
    	
    		$holYear ++;
    		error_log($holYear);
    	}

    	$this->redirect('index');
    }
}