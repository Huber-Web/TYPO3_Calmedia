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
  * Cal Controller
  */
class CalController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
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
	 * typRepository
	 * 
	 * @var \PfarreNg\Calmedia\Domain\Repository\TypRepository
	 * @inject
	 */
	protected $typRepository;
	
	/**
	 * action list
	 * 
	 * @param cat \PfarreNg\Calmedia\Domain\Model\Typ
	 * @return void
	 */
	public function listAction(\PfarreNg\Calmedia\Domain\Model\Typ $cat = null) {
		if($cat){
			$this->view->assign('dates', $this->dateRepository->listAllDates($cat));
			$this->view->assign('cat', $cat);
		}else{
			$this->view->assign('dates', $this->dateRepository->listAllDates());
		}
		$this->view->assign('holidays', $this->holidayRepository->getHolidayArray());
		$this->view->assign('types', $this->typRepository->findAll());
		$this->view->assign('googleApi', $this->settings['googleApi']);
		error_log('Test PHP');
	}
	
	public function indexAction(){
		
	}
}