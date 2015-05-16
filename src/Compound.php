<?php

class Compound
{
    private $statements;

    function __construct()
    {
        $this->statements = array();
    }

    function add($statement)
    {
        if ($statement == NULL)
            throw new InvalidArgumentException("[Compound] null statement argument");
        $this->statements[] = $statement;
    }

    function execute()
    {
        $count = 1;
        Memory::setSteps(count($this->statements));
        foreach ($this->statements as $input) {
            Memory::setPass($count++);
            $input->execute();
        }
    }
} 