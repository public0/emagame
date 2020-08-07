## Installation
```bash
./composer.phar install
```
## Dependencies
Tested on PHP 7.3.11
```bash
{
  "autoload": {
    "psr-4": {
      "Game\\":"src/"
    }
  },
  "require": {
    "symfony/event-dispatcher": "^5.1",
    "monolog/monolog": "^2.1",
    "bramus/monolog-colored-line-formatter": "^3.0"
  },
  "require-dev": {
    "phpunit/phpunit": "^9"
  }
}
```

## Run tests
```bash
./vendor/bin/phpunit --testdox
```

## Run game
```bash
php index.php
```

## Current Gameplay
1. One Hero can fight multiple enemies
2. In order to give the hero a fighting chance the hero can attack all enemies on his turn (this can be changed easily if needed in game logic)
3. Heroes and enemies alike can have special offensive/defensive abilities that are used randomly
based on their luck stat (not hardcoded ex. Rapid strike 10% chance) this can be easiliy changed if needed
4. Game ends when either all enemies have 0 hp resulting in a win or hero has 0 hp resulting in a loss
   