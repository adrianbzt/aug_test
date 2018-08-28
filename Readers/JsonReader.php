<?php

class JsonReader
{

    private $path;
    private $settings;

    public function __construct($path, $settings)
    {
        $this->path = $path;
        $this->settings = $settings;
    }

    public function getContent()
    {
        $fileContent = false;

        $handle = fopen($this->path, "r");

        //TODO: proper function to read from JSON file

        return $fileContent;
    }

}