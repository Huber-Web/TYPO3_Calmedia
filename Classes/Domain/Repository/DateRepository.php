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
 * The repository for Dates
 */
class DateRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/*
	 * Default ordering for all queries created by this repository
	 */

	protected $defaultOrderings = array(
		'date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);

	/*
	 * List Week from Yesterday a Week
	 */

	public function listWeek($cat = null) {
		$startDate = mktime(0, 0, 0, date("m", time()), date("d", time()), date("Y", time())) - 24 * 60 * 60;
		$endDate = mktime(23, 59, 59, date("m", time()), date("d", time()), date("Y", time())) + 7 * 24 * 60 * 60;
		$result = array();
		for($date = $startDate; $date <= $endDate; $date += 24 * 60 * 60){
			$query = $this->createQuery();
			if($cat){
				$query->matching(
					$query->logicalAnd(
						$query->greaterThanOrEqual('date', mktime(0, 0, 0, date("m", $date), date("d", $date), date("Y", $date))),
						$query->lessThanOrEqual('date', mktime(23, 59, 59, date("m", $date), date("d", $date), date("Y", $date))),
						$query->equals('category', $cat)
					)
				);
			}else{
				$query->matching(
					$query->logicalAnd(
						$query->greaterThanOrEqual('date', mktime(0, 0, 0, date("m", $date), date("d", $date), date("Y", $date))),
						$query->lessThanOrEqual('date', mktime(23, 59, 59, date("m", $date), date("d", $date), date("Y", $date)))
					)
				);
			}
			$result[$date]['date'] = $date;
			$result[$date]['result'] = $query->execute();
		}
		return $result;
	}

	/*
	 * List All from 2 Month ago to 8 Month in future
	 */

	public function listAllDates($cat = null) {
		$result = array();
		$year = date('Y');
		for ($month = -1; $month <= 9; $month++) {
			if ((date('m') + $month) % 13 < (date('m') - 1) % 12) {
				$year = date('Y') + 1;
			}
			$result[$year]['year'] = $year;
			if ((date('m') + $month) % 12 == 0) {
				$curMonth = 12;
			} else {
				$curMonth = (date('m') + $month) % 12;
			}
			$result[$year][$month]['month'] = mktime(0, 0, 0, $curMonth, 1, $year);
			for ($day = 1; $day <= date('t', mktime(0, 0, 0, $curMonth, 1, $year)); $day++) {
				$result[$year][$month][$day]['day'] = mktime(0, 0, 0, $curMonth, $day, $year);
				$query = $this->createQuery();
				if($cat){
					$query->matching(
						$query->logicalAnd(
							$query->greaterThanOrEqual('date', mktime(0, 0, 0, $curMonth, $day, $year)),
							$query->lessThanOrEqual('date', mktime(23, 59, 59, $curMonth, $day, $year)),
							$query->equals('category', $cat)
						)
					);
				}else{
					$query->matching(
						$query->logicalAnd(
							$query->greaterThanOrEqual('date', mktime(0, 0, 0, $curMonth, $day, $year)),
							$query->lessThanOrEqual('date', mktime(23, 59, 59, $curMonth, $day, $year))
						)
					);
				}
				$result[$year][$month][$day]['date'] = $query->execute();
			}
		}
		return $result;
	}
	
	/*
	 * List Section from 2 Month ago to 8 Month in future
	 */
	
	public function listSecDates($sec, $cat = null) {
		$result = array();
		$year = date('Y');
		for ($month = -1; $month <= 9; $month++) {
			if ((date('m') + $month) % 13 < (date('m') - 1) % 12) {
				$year = date('Y') + 1;
			}
			$result[$year]['year'] = $year;
			if ((date('m') + $month) % 12 == 0) {
				$curMonth = 12;
			} else {
				$curMonth = (date('m') + $month) % 12;
			}
			$result[$year][$month]['month'] = mktime(0, 0, 0, $curMonth, 1, $year);
			for ($day = 1; $day <= date('t', mktime(0, 0, 0, $curMonth, 1, $year)); $day++) {
				$result[$year][$month][$day]['day'] = mktime(0, 0, 0, $curMonth, $day, $year);
				$query = $this->createQuery();
				if($cat){
					$query->matching(
							$query->logicalAnd(
									$query->greaterThanOrEqual('date', mktime(0, 0, 0, $curMonth, $day, $year)),
									$query->lessThanOrEqual('date', mktime(23, 59, 59, $curMonth, $day, $year)),
									$query->equals('category', $cat),
									$query->contains('sections', $sec)
									)
							);
				}else{
					$query->matching(
							$query->logicalAnd(
									$query->greaterThanOrEqual('date', mktime(0, 0, 0, $curMonth, $day, $year)),
									$query->lessThanOrEqual('date', mktime(23, 59, 59, $curMonth, $day, $year)),
									$query->contains('sections', $sec)
									)
							);
				}
				$result[$year][$month][$day]['date'] = $query->execute();
			}
		}
		return $result;
	}
	
	public function listBackendDates($pid){
		$query = $this->createQuery();
		$query->getQuerySettings()->setStoragePageIds(array($pid));
		$query->getQuerySettings()->setIgnoreEnableFields(TRUE)->setIncludeDeleted(FALSE);
		$query->matching(
				$query->logicalAnd(
					$query->greaterThanOrEqual('date', mktime(0, 0, 0, date('m'), date('d'), date('Y')))
					)
				);
		return $query->execute();
	}
	
	public function listBackendClean($pid){
		$query = $this->createQuery();
		$query->getQuerySettings()->setStoragePageIds(array($pid));
		$query->getQuerySettings()->setIgnoreEnableFields(TRUE)->setIncludeDeleted(FALSE);
		$query->matching(
				$query->logicalAnd(
					$query->lessThan('endDate', mktime(0, 0, 0, date('m'), 1, date('Y')) - (60*60*24*60))
					)
				);
		return $query->execute();
		
	}
}