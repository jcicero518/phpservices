<?php
/**
 * Car Class
 */
// sub class - built specific to the types of objects instantiated from them
class Car extends VehicleBase
{
    public $hasTrunk; // Car's own property

    /**
     * @param $color
     * @param $type
     * @param null $hasTrunk
     */
    public function __construct($color, $type, $hasTrunk = null){
        // call the base / super class and pass params common to base class
        // sets public props in base
        // AS A RULE - if there is a base constructor, subclass constructor should call it
        parent::__construct($color, $type);
        // then set this class's property
        $this->hasTrunk = $hasTrunk;
    }
}