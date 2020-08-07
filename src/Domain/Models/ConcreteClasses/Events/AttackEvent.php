<?php
namespace Game\Domain\Models\ConcreteClasses\Events;

use Game\Domain\Models\ConcreteClasses\GameEvent;

class AttackEvent extends GameEvent
{
    const NAME = 'attack';
}