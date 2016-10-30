<?php

namespace PfarreNg\Calmedia\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Thomas Huber <thomas.huber@huber-web.at>, Pfarre Neuguntramsdorf
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \PfarreNg\Calmedia\Domain\Model\HolidayTemplate.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Thomas Huber <thomas.huber@huber-web.at>
 */
class HolidayTemplateTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \PfarreNg\Calmedia\Domain\Model\HolidayTemplate
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \PfarreNg\Calmedia\Domain\Model\HolidayTemplate();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName()
	{
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getReferenceReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getReference()
		);
	}

	/**
	 * @test
	 */
	public function setReferenceForStringSetsReference()
	{
		$this->subject->setReference('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'reference',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDaysToEasternReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setDaysToEasternForIntSetsDaysToEastern()
	{	}

	/**
	 * @test
	 */
	public function getMonthReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setMonthForIntSetsMonth()
	{	}

	/**
	 * @test
	 */
	public function getDayReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setDayForIntSetsDay()
	{	}

	/**
	 * @test
	 */
	public function getWeekAtMonthReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setWeekAtMonthForIntSetsWeekAtMonth()
	{	}

	/**
	 * @test
	 */
	public function getDayAtWeekReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setDayAtWeekForIntSetsDayAtWeek()
	{	}
}