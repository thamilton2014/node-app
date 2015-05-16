<?php

class Token
{
    public $line;

    public $tokenType;

    public $lexeme;

    public $locators;

    function __construct($line, $tokenType, $lexeme, $locators)
    {
//        $this->check_vars($line);
//        $this->check_vars($tokenType);
//        $this->check_vars($lexeme);
//        $this->check_vars($locators);

        $this->line = $line;
        $this->tokenType = $tokenType;
        $this->lexeme = $lexeme;
        $this->locators = $locators;
    }

    public function getLine()
    {
        return $this->line;
    }

    public function getTokenType()
    {
        return $this->tokenType;
    }

    public function getLexeme()
    {
        return $this->lexeme;
    }

    public function getLocators()
    {
        return $this->locators;
    }

    private function check_vars($var)
    {
        if ($var == null) {
            throw new Exception("[Token] variable is null");
        }
    }
} 