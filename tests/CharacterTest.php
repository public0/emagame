<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class CharacterTest extends TestCase
{
    public function testChampionCreation() {

        $hero = new \Game\Domain\Models\ConcreteClasses\Hero([
            'name' => 'Orderus',
            'type' => 0,
            'health' => 100,
            'strength' => 80,
            'defense' => 55,
            'speed' => 50,
            'luck' => 30,
            20
        ]);

        $this->assertEquals('Orderus', $hero->name);
        $this->assertEquals(0, $hero->type);
        $this->assertEquals(100, $hero->health);
        $this->assertEquals(80, $hero->strength);
        $this->assertEquals(55, $hero->defense);
        $this->assertEquals(30, $hero->luck);

    }

    public function testEnemyCreation() {
        $enemies = [];
        try {
            for ($i = 0; $i < 2; $i ++) {
                $enemy = \Game\Domain\Models\ConcreteClasses\EnemyFactory::create('WildBeast', [
                        'name'     => 'Wild Beast'.$i,
                        'type'     => 1,
                        'health'   => 70+$i,
                        'strength' => 70+$i,
                        'defense'  => 70+$i,
                        'speed'    => 70+$i,
                        'luck'     => 70+$i,
                        20
                    ]
                );
                $enemies[] = $enemy;

                $this->assertEquals('Wild Beast'.$i, $enemy->name);
                $this->assertEquals(1, $enemy->type);
                $this->assertEquals(70+$i, $enemy->health);
                $this->assertEquals(70+$i, $enemy->strength);
                $this->assertEquals(70+$i, $enemy->defense);
                $this->assertEquals(70+$i, $enemy->luck);

            }



        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
}