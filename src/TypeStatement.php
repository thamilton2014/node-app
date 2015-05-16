<?php

class TypeStatement implements Statement{

    public $driver;
    public $token;

    public function __construct($driver, $token)
    {
        $this->driver = $driver;
        $this->token = $token;
    }

    function execute()
    {
        preg_match('/I type (.*?) "(.*?)"$/', $this->token->getLine(), $matches);
        var_dump($matches);
        $element = new Element($this->driver, $this->token->getLocators());
        $element->whenPresent()->sendKeys($matches[2]);
    }
}