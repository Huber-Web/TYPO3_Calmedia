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
 * HolidayTemplate
 */
class HolidayTemplate extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     * 
     * @var string
     */
    protected $name = '';
    
    /**
     * reference
     * 
     * @var string
     */
    protected $reference = 'month';
    
    /**
     * daysToEastern
     * 
     * @var int
     */
    protected $daysToEastern = 0;
    
    /**
     * month
     * 
     * @var int
     */
    protected $month = 0;
    
    /**
     * day
     * 
     * @var int
     */
    protected $day = 0;
    
    /**
     * weekAtMonth
     * 
     * @var int
     */
    protected $weekAtMonth = 0;
    
    /**
     * dayAtWeek
     * 
     * @var int
     */
    protected $dayAtWeek = 0;
    
    /**
     * Returns the name
     * 
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Returns the daysToEastern
     * 
     * @return int $daysToEastern
     */
    public function getDaysToEastern()
    {
        return $this->daysToEastern;
    }
    
    /**
     * Sets the daysToEastern
     * 
     * @param int $daysToEastern
     * @return void
     */
    public function setDaysToEastern($daysToEastern)
    {
        $this->daysToEastern = $daysToEastern;
    }
    
    /**
     * Returns the month
     * 
     * @return int $month
     */
    public function getMonth()
    {
        return $this->month;
    }
    
    /**
     * Sets the month
     * 
     * @param int $month
     * @return void
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }
    
    /**
     * Returns the day
     * 
     * @return int $day
     */
    public function getDay()
    {
        return $this->day;
    }
    
    /**
     * Sets the day
     * 
     * @param int $day
     * @return void
     */
    public function setDay($day)
    {
        $this->day = $day;
    }
    
    /**
     * Returns the weekAtMonth
     * 
     * @return int $weekAtMonth
     */
    public function getWeekAtMonth()
    {
        return $this->weekAtMonth;
    }
    
    /**
     * Sets the weekAtMonth
     * 
     * @param int $weekAtMonth
     * @return void
     */
    public function setWeekAtMonth($weekAtMonth)
    {
        $this->weekAtMonth = $weekAtMonth;
    }
    
    /**
     * Returns the dayAtWeek
     * 
     * @return int $dayAtWeek
     */
    public function getDayAtWeek()
    {
        return $this->dayAtWeek;
    }
    
    /**
     * Sets the dayAtWeek
     * 
     * @param int $dayAtWeek
     * @return void
     */
    public function setDayAtWeek($dayAtWeek)
    {
        $this->dayAtWeek = $dayAtWeek;
    }
    
    /**
     * Returns the reference
     * 
     * @return string reference
     */
    public function getReference()
    {
        return $this->reference;
    }
    
    /**
     * Sets the reference
     * 
     * @param int $reference
     * @return void
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

}