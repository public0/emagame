<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;

final class BattleTest extends TestCase
{
    public function testBattleWon()
    {
        $dispatcher = $this->getMockBuilder(EventDispatcher::class)
            ->getMock();

        $hero = new \Game\Domain\Models\ConcreteClasses\Hero([
            'name' => 'Orderus',
            'type' => 0,
            'health' => 100,
            'strength' => 100,
            'defense' => 100,
            'speed' => 100,
            'luck' => 100,
            20
        ]);

        $participants[] = $hero;

        try {
            for ($i = 0; $i < 2; $i ++) {
                $enemy = \Game\Domain\Models\ConcreteClasses\EnemyFactory::create('WildBeast', [
                        'name'     => 'Wild Beast'.$i,
                        'type'     => 1,
                        'health'   => 10,
                        'strength' => 10,
                        'defense'  => 10,
                        'speed'    => 10,
                        'luck'     => 10,
                        20
                    ]
                );
                $participants[] = $enemy;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $battle = new \Game\Domain\Models\ConcreteClasses\Battle($dispatcher);
        $result = $battle->encounter($participants);
        $this->assertTrue($result);
    }

    public function testBattleLost()
    {
        $dispatcher = $this->getMockBuilder(EventDispatcher::class)
            ->getMock();

        $hero = new \Game\Domain\Models\ConcreteClasses\Hero([
            'name' => 'Orderus',
            'type' => 0,
            'health' => 10,
            'strength' => 10,
            'defense' => 10,
            'speed' => 10,
            'luck' => 10,
            20
        ]);

        $participants[] = $hero;

        try {
            for ($i = 0; $i < 2; $i ++) {
                $enemy = \Game\Domain\Models\ConcreteClasses\EnemyFactory::create('WildBeast', [
                        'name'     => 'Wild Beast'.$i,
                        'type'     => 1,
                        'health'   => 100,
                        'strength' => 100,
                        'defense'  => 100,
                        'speed'    => 100,
                        'luck'     => 100,
                        20
                    ]
                );
                $participants[] = $enemy;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $battle = new \Game\Domain\Models\ConcreteClasses\Battle($dispatcher);
        $result = $battle->encounter($participants);
        $this->assertFalse($result);
    }

}