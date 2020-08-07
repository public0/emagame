<?php

namespace Game\Domain\Models\ConcreteClasses;
use Game\Domain\Models\ConcreteClasses\Events\AttackEvent;
use Game\Domain\Models\ConcreteClasses\Events\EncounterEvent;
use Game\Domain\Models\ConcreteClasses\Events\EnemyKilledEvent;
use Game\Domain\Models\ConcreteClasses\Events\GameLostEvent;
use Game\Domain\Models\ConcreteClasses\Events\GameWonEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Battle {

    private $_participants;
    private $_dispatcher;


    public function __construct(EventDispatcher $dispatcher)
    {
        $this->_dispatcher = $dispatcher;
    }

    /*
     * This game is single player so one hero attacks multiple enemies
     */

    public function encounter($participants) :bool {
        $result = NULL;
        $this->_participants = $participants;

        $event = new EncounterEvent($this->_participants);
        $this->_dispatcher->dispatch($event, EncounterEvent::NAME);

        while(true) {
            /*
             * calculating timeline each turn since some participants might buff their own stats instead of attacking
             * or some attacks might debuff defenders stats
             * and we'd have to recalculate the timeline accordingly
             */

            $this->turnTimeline(['speed', 'luck']);
            foreach ($this->_participants as $attacker) {
                foreach ($this->_participants as $id => $defender) {
                    if($attacker->type != $defender->type) {
                        $damage = $attacker->attack($defender);
                        $event = new AttackEvent($attacker, $defender, $damage);
                        $this->_dispatcher->dispatch($event, AttackEvent::NAME);
                        if($defender->type == 0 && $defender->health <= 0) {
                            $event = new GameLostEvent($attacker, $defender, $damage);
                            $this->_dispatcher->dispatch($event, GameLostEvent::NAME);
                            $result = false;
                            break 3;
                        }
                        if($defender->type == 1 && $defender->health <= 0) {
                            $event = new EnemyKilledEvent($attacker, $defender, $damage);
                            $this->_dispatcher->dispatch($event, EnemyKilledEvent::NAME);
                            unset($this->_participants[$id]);
                        }
                        if(sizeof($this->_participants) == 1) {
                            $event = new GameWonEvent($attacker, $defender, $damage);
                            $this->_dispatcher->dispatch($event, GameWonEvent::NAME);
                            break 3;
                        }
                    }
                }
            }
        }
        return isset($result)?$result:true;
    }

    /*
     * This establishes whose turn it is to make a move
     */

    private function turnTimeline($props) {
        Battle::pSort($this->_participants, $props);
    }

    private static function pSort(&$array, $props)
    {
        usort($array, function($a, $b) use ($props) {
            if($a->{$props[0]} == $b->{$props[0]})
                return $a->{$props[1]} < $b->{$props[1]} ? 1 : -1;
            return $a->{$props[0]} < $b->{$props[0]} ? 1 : -1;
        });
    }
}