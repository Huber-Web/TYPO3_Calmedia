<?php
namespace PfarreNg\Calmedia\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Thomas Huber <thomas.huber@huber-web.at>, Pfarre Neuguntramsdorf
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
 * DateController
 */
class DateController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
	/**
	 * The feed formats and content types
	 *
	 * @var array
	 */
	protected $feedFormats = [
			'ics'  => 'text/calendar',
			'xml'  => 'application/xml',
			'atom' => 'application/rss+xml',
	];

    /**
     * dateRepository
     * 
     * @var \PfarreNg\Calmedia\Domain\Repository\DateRepository
     * @inject
     */
    protected $dateRepository = NULL;
    
    /**
     * action display
     * 
     * @param \PfarreNg\Calmedia\Domain\Model\Date $date
     * @return void
     */
    public function displayAction(\PfarreNg\Calmedia\Domain\Model\Date $date)
    {
        $this->view->assign('date', $date);
    }
    
    /**
     * action show
     * 
     * @param \PfarreNg\Calmedia\Domain\Model\Date $date
     * @return void
     */
    public function showAction(\PfarreNg\Calmedia\Domain\Model\Date $date)
    {
        $this->view->assign('prev', $this->request->getArgument('prev'));
        $this->view->assign('googleApi', $this->settings['googleApi']);
        $this->view->assign('googleHAddress', $this->settings['googleHPath']);
        $this->view->assign('googleHTitle', $this->settings['googleHTitle']);
        $this->view->assign('date', $date);
        $this->view->assign('current', new \DateTime());
        if($this->request->hasArgument('format') && $this->request->getArgument('format') == 'ics'){
        	$headers = array(
        			'Pragma' => 'public',
        			'Expires' => 0,
        			'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        			'Cache-Control' => 'public',
        			'Content-Type' => 'text/calendar',
        			'Content-Disposition' => 'attachment; filename=test.ics'
        	);
       	 
        	// send headers
        	foreach ($headers as $header => $data)
        		$this->response->setHeader($header, $data);
       		 
        	$this->response->sendHeaders();
       }
    }

}