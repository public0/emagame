<?php

namespace Game\Domain\Models\ConcreteClasses;

use Game\Domain\Models\AbstractClasses\AbstractCharacter;
use Game\Domain\Models\ConcreteClasses\Events\AttackEvent;
use Game\Domain\Models\ConcreteClasses\Traits\HeroSkills;
use Game\Domain\Models\Interfaces\CharacterInterface;

class Hero extends AbstractCharacter {
    use HeroSkills;
/*
 * In hindsight using traits might not have been the best choice
 * maybe just use a skill class and insert as a dependency
 * this still isn't that bad in my opinion just wanted to give traits a go
 */
    public function attack(CharacterInterface &$defender) : float
    {
        $attackChance = mt_rand(0, 100);
        $damage = 0;
        switch ($attackChance) {
            case ($attackChance) <= $this->luck: {
                $damage = $this->tripleStrike($defender);
            }
            break;
            case ($attackChance/2)<= $this->luck: {
                $damage = $this->doubleStrike($defender);
            }
            break;
            default: {
                $damage = $this->basicStrike($defender);
            }
        }

        return $damage;

    }

    public function defend(CharacterInterface &$attacker) {
        $defendChance = mt_rand(0, 100);
        $defense = 0;
        switch ($defendChance) {
            default: {
                $defense = $this->basicDefend($attacker);
            }
        }
        return $defense;
    }
}