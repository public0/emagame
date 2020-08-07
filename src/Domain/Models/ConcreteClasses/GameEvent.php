<?php

namespace Game\Domain\Models\ConcreteClasses;
use Game\Domain\Models\Interfaces\CharacterInterface;
use Symfony\Contracts\EventDispatcher\Event;

class GameEvent extends Event{
    const NAME = '';

    private $_attacker;
    private $_defender;
    private $_damage;

    public function __construct(CharacterInterface &$attacker = NULL, CharacterInterface &$defender = NULL, int $damage = NULL)
    {
        $this->_attacker = $attacker;
        $this->_defender = $defender;
        $this->_damage   = $damage;
    }

    public function getAttacker() {
        return $this->_attacker;
    }

    public function getDefender() {
        return $this->_defender;
    }

    public function getDamage() {
        return $this->_damage;
    }

}