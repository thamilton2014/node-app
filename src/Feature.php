<?php

class Feature {

    private $driver;
    private $compound;
    private $filename;

    function __construct($driver, $compound, $filename)
    {
        if($compound == NULL)
            throw new InvalidArgumentException("[Feature] null compound argument");
        if($driver == NULL){
            throw new InvalidArgumentException("[Feature] null driver argument");
        }
        $this->driver = $driver;
        $this->compound = $compound;
        $this->filename = $filename;
    }

    function execute()
    {
        $this->compound->execute();
        $screenshot = "../screenshots/" . $this->filename . ".png";
        $this->driver->takeScreenshot($screenshot);
        $this->driver->close();
    }

} 