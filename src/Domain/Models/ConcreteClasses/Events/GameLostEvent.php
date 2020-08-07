<?php
namespace Game\Domain\Models\ConcreteClasses\Events;

use Game\Domain\Models\ConcreteClasses\GameEvent;

class GameLostEvent extends GameEvent
{
    const NAME = 'lost';
}