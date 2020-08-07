<?php
namespace Game\Domain\Exceptions;

class ObjectNotFoundException extends \Exception {

    public function __construct($e)
    {
        $this->message  = $e;
        $this->code     = "20002";
        parent::__construct($this->message, $this->code);
    }
}
