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

    public function getContentFromCsv()
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

                        foreach ($header as $key => $value) {
                            $row[trim($value)] = trim($explodedLine[$key]);
                        }

                        $fileContent[] = $row;


                    }

                    $key++;


                    if ($this->settings['users']) {

                    } else {

                    }
                }

                fclose($handle);
            } else {
                // error opening the file.
            }
        }

        return $fileContent;
    }

}