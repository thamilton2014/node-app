<?php

class Memory
{

    private static $results = array('time' => 0, 'pass' => 0, 'fail' => 0, 'error' => "", 'steps' => 0);

    private static $mem = array('a' => 0, 'b' => 0, 'c' => 0, 'd' => 0, 'e' => 0, 'f' => 0, 'g' => 0,
        'h' => 0, 'i' => 0, 'j' => 0, 'k' => 0, 'l' => 0, 'm' => 0, 'n' => 0, 'o' => 0,
        'p' => 0, 'q' => 0, 'r' => 0, 's' => 0, 't' => 0, 'u' => 0, 'v' => 0, 'w' => 0,
        'x' => 0, 'y' => 0, 'z' => 0);

    function __construct()
    {

    }

    static function fetch($char)
    {
        if ($char == NULL)
            throw new InvalidArgumentException("[Memory] null character argument");
        return self::$mem[$char];
    }

    static function setPass($param)
    {
        self::$results['pass'] = $param;
    }

    static function setFail($param)
    {
        self::$results['fail'] = $param;
    }

    static function setMessage($param)
    {
        self::$results['message'] = $param;
    }

    static function setSteps($param)
    {
        self::$results['steps'] = $param;
    }

    static function store($index, $param)
    {
        if ($index == NULL)
            throw new InvalidArgumentException("[Memory] null index argument");
        if ($param == NULL)
            throw new InvalidArgumentException("[Memory] null param argument");
        self::$mem[$index->get_char()] = (int)$param;
    }

    static public function display_memory()
    {
//        print_r(self::$mem);
        print_r(self::$results);
    }
} 