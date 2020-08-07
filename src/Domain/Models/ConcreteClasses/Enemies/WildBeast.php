<?php

namespace Game\Domain\Models\ConcreteClasses\Enemies;

use Game\Domain\Models\AbstractClasses\AbstractCharacter;
use Game\Domain\Models\ConcreteClasses\Traits\WildBeastSkills;
use Game\Domain\Models\Interfaces\CharacterInterface;

class WildBeast extends AbstractCharacter {
    use WildBeastSkills;

    public function attack(CharacterInterface &$defender) : float
    {
        $attackChance = mt_rand(0, 100);
        $damage = 0;

        switch ($attackChance) {
            case ($attackChance) <= $this->luck: {
                $damage = $this->acidSpit($defender);
            };
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
            case ($defendChance) <= $this->luck: {
                $defense = $this->pogChamp($attacker);
            }
            break;
            default: {
                $defense = $this->basicDefend($attacker);
            }
        }
        return $defense;

    }

}