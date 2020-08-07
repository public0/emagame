<?php

namespace Game\Domain\Models\AbstractClasses;

use Game\Domain\Models\Interfaces\CharacterInterface;

class AbstractCharacter implements CharacterInterface {
    private $_name = '';
    /*
     * type: 0 the hero
     * type: 1 not the hero
     */
    private $_type = 0;
    private $_health = 0;
    private $_strength = 0;
    private $_defense = 0;
    private $_speed = 0;
    private $_luck = 0;
    private $_last;

    public function __construct(array $stats)
    {
        if(!empty($stats)) {
            $this->_name       = $stats['name'];
            $this->_type       = $stats['type'];
            $this->_health     = $stats['health'];
            $this->_strength   = $stats['strength'];
            $this->_defense    = $stats['defense'];
            $this->_speed      = $stats['speed'];
            $this->_luck       = $stats['luck'];
            $this->_last       = '';
        }
    }

    public function attack(CharacterInterface &$defender) : float {
        $damage = $this->_strength - $defender->defend;
        $defender->health -= $damage;
        $this->_last = 'basic strike';

        return $damage;
//        echo "{$this->_name} attacked {$defender->name} for {$damage}. {$defender->name} has {$defender->health}\n";
    }

    public function defend(CharacterInterface &$attacker) {
        $this->_last = 'basic defend';
        return [$this->last, $this->defense];

        //echo $this->_name.' defended!'.PHP_EOL;
    }


/*
 *  maybe not very ideal to use magic here
 *  but imma stick with this for ease of use
 */

    public function __get($propertyName){
        $prop = '_'.$propertyName;
        return isset($this->$prop)? $this->$prop:NULL;
    }

    public function __set($propertyName, $propertyValue){
        $prop = '_'.$propertyName;
        if(isset($this->$prop))
        $this->$prop = $propertyValue;
    }

}