<?php
require 'Token.php';
require 'TokenType.php';
require 'LexicalException.php';

class LexicalAnalyzer
{
    private $token_list;

    function __construct($file_name)
    {
        $language = $this->get_language('../config/language.json');

        $file_contents = file_get_contents($file_name);
        $lines = preg_split('/[\n]+/', $file_contents, -1, PREG_SPLIT_NO_EMPTY);
        foreach($lines as $line){
            $tokenType = $this->get_token_type($line);
            $lexeme = $this->get_lexeme($line);
            $locators = $this->get_locators($lexeme, $language);
            $token = new Token($line, $tokenType, $lexeme, $locators);
            $this->token_list[] = $token;
        }
        $token = new Token("", TokenType::EOS_TOK, "EOS", []);
        $this->token_list[] = $token;
    }

    private function get_language($file)
    {
        return file_get_contents($file);
    }

    private function get_locators($lexeme, $language)
    {
        $jsonFile = json_decode($language, true);
        $locators = null;
        for($i = 0; $i < count($jsonFile); $i++){
            if($jsonFile[$i]['token']['lexeme'] === $lexeme){
                $locators = $jsonFile[$i]['token']['locators'];
            }
        }
        return $locators;
    }

    private function get_token_type($line)
    {
        if (preg_match('/Feature(.*?)/', $line) === 1) {
            $tokenType = TokenType::FEATURE_TOK;
        } else if (preg_match('/Scenario(.*?)/', $line) === 1) {
            $tokenType = TokenType::SCENARIO_TOK;
        } else if (preg_match('/I click on (.*?)$/', $line) === 1) {
            $tokenType = TokenType::CLICK_TOK;
        } else if (preg_match('/I type (.*?) "(.*?)"$/', $line) === 1) {
            $tokenType = TokenType::TYPE_TOK;
        } else
            throw new Exception("token type not found");
        return $tokenType;
    }

    private function get_lexeme($line)
    {
        $lexeme = null;
        if (preg_match('/Feature(.*?)/', $line, $matches) === 1) {
            $lexeme = $matches[1];
        } else if (preg_match('/Scenario(.*?)/', $line, $matches) === 1) {
            $lexeme = $matches[1];
        } else if (preg_match('/I click on (.*?)$/', $line, $matches) === 1) {
            $lexeme = $matches[1];
        } else if (preg_match('/I type (.*?) "(.*?)"$/', $line, $matches) === 1) {
            $lexeme = $matches[1];
        } else
            throw new Exception("token type not found");
        return $lexeme;
    }

    function get_look_ahead_token()
    {
        if ($this->token_list === NULL)
            throw new LexicalException("No more tokens");
        return $this->token_list[0];
    }

    function get_next_token()
    {
        if ($this->token_list === NULL)
            throw new LexicalException("No more tokens");
        $token = $this->token_list[0];
        unset($this->token_list[0]);
        $this->token_list = array_values($this->token_list);
        return $token;
    }

}