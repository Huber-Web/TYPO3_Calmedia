<?php
namespace PfarreNg\Calmedia\Domain\Repository;


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
 * The repository for Holidays
 */
class HolidayRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/*
	 * Default ordering for all queries created by this repository
	 */

	protected $defaultOrderings = array(
		'date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
		'name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);

	/*
	 * List array with date and title
	 */
	public function getHolidayArray(){
		$holidays = $this->createQuery()->execute();
		$result = array();
		foreach ($holidays as $holiday){
			$date = $holiday->getDate()->getTimestamp();
			$result[$date] = $holiday->getName();
		}
		return $result;
	}
	
	/*
	 * List all Holidays at the feature
	 * 
	 * @param pid
	 * return list
	 */
	public function listBackendHolidays($pid){
		$query = $this->createQuery();
		$query->getQuerySettings()->setStoragePageIds(array($pid));
		$query->matching(
				$query->logicalAnd(
						$query->greaterThanOrEqual('date', mktime(0, 0, 0, date('m'), date('d'), date('Y')))
						)
				);
		return $query->execute();
	}
	
	/*
	 * Check if date is free
	 * 
	 * @param pid
	 * @param date
	 * return check
	 */
	public function checkDate($pid, $date){
		$query = $this->createQuery();
		$query->getQuerySettings()->setStoragePageIds(array($pid));
		$query->matching(
				$query->logicalAnd(
						$query->equals('date',$date)
						)
				);
		$result = $query->execute()->count();
		if ($result == 0) {
			return true;
		}else{
			return false;
		}
	}
}