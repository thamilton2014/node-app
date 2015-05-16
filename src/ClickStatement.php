<?php

class ClickStatement implements Statement
{
    public $driver;

    public $token;

    public function __construct($driver, $token)
    {
        $this->driver = $driver;
        $this->token = $token;
    }

    function execute()
    {
        $element = new Element($this->driver, $this->token->getLocators());
        $element->whenPresent()->click();
    }
}