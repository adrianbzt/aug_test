<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include dirname(__FILE__) . "/Readers/CsvReader.php";


class UsersApi
{

    public function run()
    {

        $settings = array(
            "users" => isset($_GET['users']) ? $_GET['users'] : true,
            "limit" => isset($_GET['limit']) ? $_GET['limit'] : false,
            "offset" => isset($_GET['offset']) ? $_GET['offset'] : false,
            "name" => isset($_GET['name']) ? $_GET['name'] : false,
        );

        $result = $this->getContent('csv', $settings);

        echo json_encode($result, JSON_PRETTY_PRINT);
    }


    private function getContent($type, $settings)
    {

        switch ($type) {
            case 'csv':
                $csvReader = new CsvReader((__DIR__) . '/sources/testtakers.csv', $settings);
                return $csvReader->getContentFromCsv($settings);
                break;
            case 'json':
                return $this->getContentFromJson($settings);
                break;
            default:
                break;
        }

    }

    private function getContentFromJson($settings)
    {

        $path = (__DIR__) . '/sources/testtakers.json';

    }

}

$user = new UsersApi();
$user->run();