<?php
require 'Parser.php';
require 'Memory.php';

class Interpreter
{
    function main()
    {
        try {
            $file = "/Users/thamilton/PhpstormProjects/test-app/php_interpreter/test_data/testfile.feature";
            $parser = new Parser($file);
            $feature = $parser->feature(basename($file, ".feature"));
            $feature->execute();
//        Memory::display_memory();
        } catch(Exception $e) {
            Memory::setMessage($e);
        }
        Memory::display_memory();
    }
}

$run = new Interpreter();
$run->main();
