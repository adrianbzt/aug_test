<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include dirname(__FILE__) . "/Readers/CsvReader.php";
include dirname(__FILE__) . "/Readers/JsonReader.php";


class UsersApi
{

    public function run()
    {

        // TODO: differentiate users by user and apply filters
        $settings = array(
            "users" => isset($_GET['users']) ? $_GET['users'] : true,
            "limit" => isset($_GET['limit']) ? $_GET['limit'] : false,
            "offset" => isset($_GET['offset']) ? $_GET['offset'] : false,
            "name" => isset($_GET['name']) ? $_GET['name'] : false,
            "email" => isset($_GET['email']) ? $_GET['email'] : false,
        );

        $result = $this->getContent('csv', $settings);

        echo json_encode($result, JSON_PRETTY_PRINT);
    }


    private function getContent($type, $settings)
    {

        switch ($type) {
            case 'csv':
                $csvReader = new CsvReader((__DIR__) . '/sources/testtakers.csv', $settings);
                return $csvReader->getContent($settings);
                break;
            case 'json':
                $jsonReader = new JsonReader((__DIR__) . '/sources/testtakers.json', $settings);
                return $jsonReader->getContent($settings);
                break;
            default:
                break;
        }

    }

}

$user = new UsersApi();
$user->run();