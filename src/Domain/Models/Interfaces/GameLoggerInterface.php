<?php

namespace Game\Domain\Models\Interfaces;

interface GameLoggerInterface {
    public function info($message);
    public function alert($message);
}