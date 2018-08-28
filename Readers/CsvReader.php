<?php

class CsvReader
{

    private $path;
    private $settings;
    private $conditions;

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
        $headerInv = [];

        if (file_exists($this->path)) {
            if ($handle) {
                while (($line = fgets($handle)) !== false) {

                    $explodedLine = explode(',', trim($line));

                    if ($key === 0) {
                        $header = $explodedLine;
                        $headerInv = array_flip($explodedLine);

                        foreach ($this->settings as $filter => $filterValue) {
                            if ($filterValue !== '') {
                                $this->conditions[$headerInv[$filter]] = $filterValue;
                            }
                        }

                    } else {

                        $row = [];
                        $importLine = $this->checkIfLineMustBeImported($explodedLine);

                        if ($importLine) {
                            foreach ($header as $key => $value) {
                                $row[trim($value)] = trim($explodedLine[$key]);
                            }
                            $fileContent[] = $row;
                        }
                    }
                    $key++;
                }

                fclose($handle);
            }
        }

        return $fileContent;
    }

    private function checkIfLineMustBeImported($explodedLine)
    {
        $importLine = false;

        if (!empty($this->conditions)) {
            foreach ($this->conditions as $index => $val) {
                if (strtolower($explodedLine[$index]) === strtolower($val)) {
                    $importLine = true;
                }
            }
        } else {
            $importLine = true;
        }


        return $importLine;
    }

}