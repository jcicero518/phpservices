<?php
/**
 * Train Class
 */

class Train extends VehicleBase
{
    public $carCount; // Train's own property

    /**
     * @param $color
     * @param $type
     * @param null $carCount
     */
    public function __construct($color, $type, $carCount = null){
        // call the base / super class and pass params common to base class
        // sets public props in base
        parent::__construct($color, $type);
        // then set this class's property
        $this->carCount = $carCount;
    }
}