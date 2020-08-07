<?php

namespace Game\Domain\Models\ConcreteClasses\Traits;

use Game\Domain\Models\Interfaces\CharacterInterface;

trait WildBeastSkills{

    protected function basicStrike(CharacterInterface &$defender) {
        $damage = $this->strength - $defender->defend($this);
        $defender->health -= $damage;
        $this->last = 'basic strike';
        return $damage;
    }

    public function acidSpit(CharacterInterface &$defender) {
        $damage = (1.5*$this->strength) - $defender->defend($this);
        $defender->health -= $damage;
        $this->last = 'acid spit';
        return $damage;
    }

    public function pogChamp(CharacterInterface &$attacker) {
        $this->last = 'Pog Champ + 0.5 defense';
        return $this->defense*.5;
    }

    protected function basicDefend(CharacterInterface &$attacker) {
        $this->last = 'basic defend';
        return $this->defense;
    }

}