<?php

namespace Game\Domain\Models\Interfaces;

interface CharacterInterface {
    public function attack(CharacterInterface &$defender) : float;
    public function defend(CharacterInterface &$attacker);
}