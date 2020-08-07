<?php

require_once "vendor/autoload.php";

use Symfony\Component\EventDispatcher\EventDispatcher;
use Game\Domain\Models\ConcreteClasses\Events\AttackEvent;
use Game\Domain\Models\ConcreteClasses\Events\GameLostEvent;
use Game\Domain\Models\ConcreteClasses\Events\EnemyKilledEvent;
use Game\Domain\Models\ConcreteClasses\Events\GameWonEvent;
use Game\Domain\Models\ConcreteClasses\Events\EncounterEvent;
use Game\Domain\Models\ConcreteClasses\GameLogger;
$participants = [];
$dispatcher = new EventDispatcher();
$logger = new GameLogger();
$gameListener = new \Game\Domain\Models\ConcreteClasses\Events\GameListener($logger);

$dispatcher->addListener(
    EncounterEvent::NAME,
    [
        $gameListener,
        'encounter'
    ]);

$dispatcher->addListener(
    AttackEvent::NAME,
    [
        $gameListener,
        'action'
    ]);

$dispatcher->addListener(
    GameLostEvent::NAME,
    [
        $gameListener,
        'lost'
    ]);

$dispatcher->addListener(
    EnemyKilledEvent::NAME,
    [
        $gameListener,
        'killed'
    ]);

$dispatcher->addListener(
    GameWonEvent::NAME,
    [
        $gameListener,
        'won'
    ]);

$hero = new \Game\Domain\Models\ConcreteClasses\Hero([
    'name' => 'Orderus',
    'type' => 0,
    'health' => mt_rand(70, 100),
    'strength' => mt_rand(70, 80),
    'defense' => mt_rand(45, 55),
    'speed' => mt_rand(40, 50),
    'luck' => mt_rand(10, 30),
    20
]);

$participants[] = $hero;

try {
    for ($i = 0; $i < 2; $i ++) {
        $enemy = \Game\Domain\Models\ConcreteClasses\EnemyFactory::create('WildBeast', [
                'name'     => 'Wild Beast'.$i,
                'type'     => 1,
                'health'   => mt_rand(70, 100),
                'strength' => mt_rand(70, 80),
                'defense'  => mt_rand(45, 55),
                'speed'    => mt_rand(40, 50),
                'luck'     => mt_rand(10, 30),
                20
            ]
        );
        $participants[] = $enemy;
    }

} catch (Exception $e) {
    echo $e->getMessage();
}

$battle = new \Game\Domain\Models\ConcreteClasses\Battle($dispatcher);
$battle->encounter($participants);