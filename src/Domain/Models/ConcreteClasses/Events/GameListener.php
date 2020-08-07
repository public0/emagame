<?php

namespace Game\Domain\Models\ConcreteClasses\Events;

use Game\Domain\Models\Interfaces\GameLoggerInterface;
use Symfony\Contracts\EventDispatcher\Event;
/*
 * Decided on having only one listener just to make things a bit easier for me
 * ideally you'd spread these apart accordingly
 */

class GameListener
{
    private $_logger;
    private $_attacker;
    private $_defender;

    public function  __construct(GameLoggerInterface $logger) {
        $this->_logger = $logger;
    }

    public function encounter(Event $event)
    {
        $participants = $event->getParticipants();
        $log = "---- Fight Participants ----\n";

        foreach ($participants as $p) {
            $log .= <<<BATTLELOG
{$p->name}
HEALTH: {$p->health}
STRENGTH: {$p->strength}
DEFENSE: {$p->defense}
SPEED: {$p->speed}
LUCK: {$p->luck}
\n
BATTLELOG;

        }


        $this->_logger->notice($log);

    }

    public function action(Event $event)
    {
        $this->_attacker = $event->getAttacker();
        $this->_defender= $event->getDefender();
        $damage  = $event->getDamage();

        $log2 = <<<BATTLELOG
{{$this->_attacker->name}} attacks {{$this->_defender->name}} with {{$this->_attacker->last}},
{{$this->_defender->name}} defends with {{$this->_defender->last}} 
{{$this->_defender->name}} takes {{$damage}} damage and has {{$this->_defender->health}} HP left
-
BATTLELOG;

        $log = "{$this->_attacker->name} attacked {$this->_defender->name} for {$damage}
        ";
        $this->_logger->info($log2);
 
    }

    public function lost(Event $event)
    {
        $this->_attacker = $event->getAttacker();
        $this->_defender= $event->getDefender();
        $damage  = $event->getDamage();

        $log = <<<BATTLELOG
{{$this->_defender->name}} died, unlucky :(
BATTLELOG;

        $this->_logger->critical($log);

    }

    public function killed(Event $event)
    {
        $this->_attacker = $event->getAttacker();
        $this->_defender= $event->getDefender();
        $damage  = $event->getDamage();

        $log = <<<BATTLELOG
{{$this->_defender->name}} died.
BATTLELOG;

        $this->_logger->notice($log);

    }

    public function won(Event $event)
    {
        $this->_attacker = $event->getAttacker();
        $this->_defender= $event->getDefender();
        $damage  = $event->getDamage();

        $log = <<<BATTLELOG
{{$this->_attacker->name}} won the encounter.
BATTLELOG;

        $this->_logger->notice($log);

    }
}
