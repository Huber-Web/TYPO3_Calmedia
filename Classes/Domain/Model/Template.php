<?php
namespace PfarreNg\Calmedia\Domain\Model;

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
 * Templates
 */
class Template extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     * 
     * @var string
     */
    protected $title = '';
    
    /**
     * descriptionShort
     * 
     * @var string
     */
    protected $descriptionShort = '';
    
    /**
     * description
     * 
     * @var string
     */
    protected $description = '';
    
    /**
     * location
     * 
     * @var string
     */
    protected $location = '';
    
    /**
     * address
     * 
     * @var string
     */
    protected $address = '';
    
    /**
     * category
     * 
     * @var \PfarreNg\Calmedia\Domain\Model\Typ
     */
    protected $category = null;
    
    /**
     * sections
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PfarreNg\Calmedia\Domain\Model\Section>
     */
    protected $sections = null;
    
    /**
     * place
     * 
     * @var \PfarreNg\Calmedia\Domain\Model\Place
     */
    protected $place = null;
    
    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns the descriptionShort
     * 
     * @return string $descriptionShort
     */
    public function getDescriptionShort()
    {
        return $this->descriptionShort;
    }
    
    /**
     * Sets the descriptionShort
     * 
     * @param string $descriptionShort
     * @return void
     */
    public function setDescriptionShort($descriptionShort)
    {
        $this->descriptionShort = $descriptionShort;
    }
    
    /**
     * Returns the description
     * 
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the description
     * 
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Returns the location
     * 
     * @return string $location
     */
    public function getLocation()
    {
        return $this->location;
    }
    
    /**
     * Sets the location
     * 
     * @param string $location
     * @return void
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
    
    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->sections = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the category
     * 
     * @return \PfarreNg\Calmedia\Domain\Model\Typ $category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Sets the category
     * 
     * @param \PfarreNg\Calmedia\Domain\Model\Typ $category
     * @return void
     */
    public function setCategory(\PfarreNg\Calmedia\Domain\Model\Typ $category)
    {
        $this->category = $category;
    }
    
    /**
     * Adds a Section
     * 
     * @param \PfarreNg\Calmedia\Domain\Model\Section $section
     * @return void
     */
    public function addSection(\PfarreNg\Calmedia\Domain\Model\Section $section)
    {
        $this->sections->attach($section);
    }
    
    /**
     * Removes a Section
     * 
     * @param \PfarreNg\Calmedia\Domain\Model\Section $sectionToRemove The Section to be removed
     * @return void
     */
    public function removeSection(\PfarreNg\Calmedia\Domain\Model\Section $sectionToRemove)
    {
        $this->sections->detach($sectionToRemove);
    }
    
    /**
     * Returns the sections
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PfarreNg\Calmedia\Domain\Model\Section> $sections
     */
    public function getSections()
    {
        return $this->sections;
    }
    
    /**
     * Sets the sections
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PfarreNg\Calmedia\Domain\Model\Section> $sections
     * @return void
     */
    public function setSections(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $sections)
    {
        $this->sections = $sections;
    }
    
    /**
     * Returns the place
     * 
     * @return \PfarreNg\Calmedia\Domain\Model\Place $place
     */
    public function getPlace()
    {
        return $this->place;
    }
    
    /**
     * Sets the place
     * 
     * @param \PfarreNg\Calmedia\Domain\Model\Place $place
     * @return void
     */
    public function setPlace(\PfarreNg\Calmedia\Domain\Model\Place $place)
    {
        $this->place = $place;
    }
    
    /**
     * Returns the address
     * 
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * Sets the address
     * 
     * @param string $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

}