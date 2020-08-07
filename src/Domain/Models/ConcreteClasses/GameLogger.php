<?php

namespace Game\Domain\Models\ConcreteClasses;
use Game\Domain\Models\Interfaces\GameLoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use \Bramus\Monolog\Formatter\ColoredLineFormatter;

class GameLogger implements GameLoggerInterface {

    private $_logger;

    public function __construct()
    {
        $this->_logger = new Logger('logger');
        $output = "%message%\n";
        $formatter = new ColoredLineFormatter(NULL,$output,NULL, true, true);
        $handler = new StreamHandler('php://stdout');
        $handler->setFormatter($formatter);
        $this->_logger->pushHandler($handler);
    }

    public function info($message) {
        $this->_logger->info($message);
    }

    public function alert($message) {
        $this->_logger->alert($message);
    }

    public function notice($message) {
        $this->_logger->notice($message);
    }

    public function critical($message) {
        $this->_logger->critical($message);
    }
}