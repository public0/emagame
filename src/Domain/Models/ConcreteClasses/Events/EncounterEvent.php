<?php
namespace Game\Domain\Models\ConcreteClasses\Events;

use Symfony\Contracts\EventDispatcher\Event;

class EncounterEvent extends Event
{
    const NAME = 'new.encounter';
    private $_participants;

    public function __construct(array $participants)
    {
        $this->_participants = $participants;


    }

    public function getParticipants() {
        return $this->_participants;
    }
}