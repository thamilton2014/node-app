<?php
require 'LexicalAnalyzer.php';
require 'ParserException.php';
require 'Feature.php';
require 'Compound.php';
require 'Statement.php';
require 'Element.php';
require 'By.php';
require 'ClickStatement.php';
require 'TypeStatement.php';

require_once('../vendor/facebook/webdriver/lib/__init__.php');

class Parser
{
    private $lex;
    private $driver;

    function __construct($file)
    {
        if ($file === NULL)
            throw new InvalidArgumentException("invalid file name argument");
        $this->lex = new LexicalAnalyzer($file);
        $cap = DesiredCapabilities::firefox();
        $this->driver = RemoteWebDriver::create("http://localhost:4444/wd/hub", $cap);
        $this->driver->get("http://cs.kennesaw.edu/");
    }

    function feature($filename)
    {
        $this->match($this->get_next_token(), TokenType::FEATURE_TOK);
        $this->match($this->get_next_token(), TokenType::SCENARIO_TOK);
        $compound = $this->get_compound();
        if ($this->get_next_token()->getTokenType() != TokenType::EOS_TOK) {
            throw new ParserException("garbage at end of program");
        }
        return new Feature($this->driver, $compound, $filename);
    }

    function get_compound()
    {
        $statement = $this->get_statement();
        $compound = new Compound();
        $compound->add($statement);
        $token = $this->get_look_ahead_token();
        while ($this->is_valid_start($token)) {
            $statement = $this->get_statement();
            $compound->add($statement);
            $token = $this->get_look_ahead_token();
        }
        return $compound;
    }

    function is_valid_start($token)
    {
        if ($token == NULL)
            throw new ParserException("token is null");
        return $token->getTokenType() === TokenTYpe::CLICK_TOK || $token->getTokenType() === TokenType::TYPE_TOK;
    }

    function get_statement()
    {
        $token = $this->get_look_ahead_token();
        switch ($token->getTokenType()) {
            case TokenType::CLICK_TOK:
                $statement = $this->get_click_statement();
                break;
            case TokenType::TYPE_TOK:
                $statement = $this->get_type_statement();
                break;
            default:
                throw new ParserException("statement initializing lexeme expected");
        }
        return $statement;
    }

    private function get_click_statement()
    {
        return new ClickStatement($this->driver, $this->get_next_token());
    }

    private function get_type_statement()
    {
        return new TypeStatement($this->driver, $this->get_next_token());
    }


    function match($token, $token_type)
    {
        if ($token->getTokenType() != $token_type)
            throw new ParserException("error matching");
    }

    function get_next_token()
    {
        return $this->lex->get_next_token();
    }

    function get_look_ahead_token()
    {
        return $this->lex->get_look_ahead_token();
    }


} 