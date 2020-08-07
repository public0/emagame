<?php
namespace Game\Domain\Models\ConcreteClasses\Events;

use Game\Domain\Models\ConcreteClasses\GameEvent;
use Game\Domain\Models\Interfaces\CharacterInterface;

class EnemyKilledEvent extends GameEvent
{
    const NAME = 'killed';
}