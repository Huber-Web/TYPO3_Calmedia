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
 * Test case for class \PfarreNg\Calmedia\Domain\Model\Template.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Thomas Huber <thomas.huber@huber-web.at>
 */
class TemplateTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \PfarreNg\Calmedia\Domain\Model\Template
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \PfarreNg\Calmedia\Domain\Model\Template();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle()
	{
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionShortReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDescriptionShort()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionShortForStringSetsDescriptionShort()
	{
		$this->subject->setDescriptionShort('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'descriptionShort',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription()
	{
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLocationReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getLocation()
		);
	}

	/**
	 * @test
	 */
	public function setLocationForStringSetsLocation()
	{
		$this->subject->setLocation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'location',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAddressReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getAddress()
		);
	}

	/**
	 * @test
	 */
	public function setAddressForStringSetsAddress()
	{
		$this->subject->setAddress('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'address',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForTyp()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getCategory()
		);
	}

	/**
	 * @test
	 */
	public function setCategoryForTypSetsCategory()
	{
		$categoryFixture = new \PfarreNg\Calmedia\Domain\Model\Typ();
		$this->subject->setCategory($categoryFixture);

		$this->assertAttributeEquals(
			$categoryFixture,
			'category',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSectionsReturnsInitialValueForSection()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getSections()
		);
	}

	/**
	 * @test
	 */
	public function setSectionsForObjectStorageContainingSectionSetsSections()
	{
		$section = new \PfarreNg\Calmedia\Domain\Model\Section();
		$objectStorageHoldingExactlyOneSections = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneSections->attach($section);
		$this->subject->setSections($objectStorageHoldingExactlyOneSections);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneSections,
			'sections',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addSectionToObjectStorageHoldingSections()
	{
		$section = new \PfarreNg\Calmedia\Domain\Model\Section();
		$sectionsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$sectionsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($section));
		$this->inject($this->subject, 'sections', $sectionsObjectStorageMock);

		$this->subject->addSection($section);
	}

	/**
	 * @test
	 */
	public function removeSectionFromObjectStorageHoldingSections()
	{
		$section = new \PfarreNg\Calmedia\Domain\Model\Section();
		$sectionsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$sectionsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($section));
		$this->inject($this->subject, 'sections', $sectionsObjectStorageMock);

		$this->subject->removeSection($section);

	}

	/**
	 * @test
	 */
	public function getPlaceReturnsInitialValueForPlace()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getPlace()
		);
	}

	/**
	 * @test
	 */
	public function setPlaceForPlaceSetsPlace()
	{
		$placeFixture = new \PfarreNg\Calmedia\Domain\Model\Place();
		$this->subject->setPlace($placeFixture);

		$this->assertAttributeEquals(
			$placeFixture,
			'place',
			$this->subject
		);
	}
}
