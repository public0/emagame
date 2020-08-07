<?php

namespace Game\Domain\Models\ConcreteClasses\Traits;

use Game\Domain\Models\Interfaces\CharacterInterface;

trait HeroSkills{
    public function __construct(array $stats = [])
    {
        parent::__construct($stats);
    }

    protected function basicStrike(CharacterInterface &$defender) {
        $damage = $this->strength - $defender->defend($this);
        $defender->health -= $damage;
        $this->last = 'basic strike';
        return $damage;
    }

    protected function doubleStrike(CharacterInterface &$defender) {
        $damage = (2*$this->strength) - $defender->defend($this);
        $defender->health -= $damage;
        $this->last = 'double strike';
        return $damage;
    }

    protected function tripleStrike(CharacterInterface &$defender) {
        $damage = (3*$this->strength) - $defender->defend($this);
        $defender->health -= $damage;
        $this->last = 'triple strike';
        return $damage;
    }

    protected function basicDefend(CharacterInterface &$attacker) {
        $this->last = 'basic defend';
        return $this->defense;
    }

    public function magicShield() {

    }
}