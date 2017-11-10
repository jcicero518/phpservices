<?php
/**
 * Vehicle Base
 */
// keep base class general in scope, containing props / methods
// that have some commonality / pertain to all sub classes
class VehicleBase
{
    public $color;
    public $type;

    /**
     * @param $color
     * @param $type
     */
    // base constructor accepts and sets properties common to all
    // classes that will extend it
    public function __construct($color, $type){
        $this->color = $color;
        $this->type = $type;
    }
}