<?php

namespace Game\Domain\Models\ConcreteClasses;

/*
  * Decided to go with multiple types of enemy classes instead of on enemy class where we just add
  * different params to constructor to differentiate between types of enemies
  * so we would use a factory to create multiple types of enemies in one encounter
  * */

use Game\Domain\Exceptions\ObjectNotFoundException;

class EnemyFactory {
    private $_instance;

    public static function create($source, array $data = [])
    {
        if (!class_exists('Game\\Domain\\Models\\ConcreteClasses\\Enemies\\'.$source)) {
            throw new ObjectNotFoundException(sprintf('EnemyFactory Exception: Class %s not found.',
                '\\Game\\Domain\\Models\\ConcreteClasses\\Enemies\\'.$source));
        }

        $class = sprintf('\Game\Domain\Models\ConcreteClasses\Enemies\%s', $source);
        return new $class($data);
    }
}