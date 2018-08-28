<?php

class CsvReader
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

        $key = 0;
        $header = [];


        if (file_exists($this->path)) {
            if ($handle) {
                while (($line = fgets($handle)) !== false) {

                    $explodedLine = explode(',', $line);

                    if ($key === 0) {
                        $header = $explodedLine;
                    } else {

                        $row = [];

                        //TODO: filter values by settings received
                        foreach ($header as $key => $value) {
                            $row[trim($value)] = trim($explodedLine[$key]);
                        }
                        $fileContent[] = $row;

                    }
                    $key++;
                }

                fclose($handle);
            }
        }

        return $fileContent;
    }

}