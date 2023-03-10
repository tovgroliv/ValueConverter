<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php");

class DataBase
{
    private static $connection;

    private static function connectToDataBase()
    {
        $dotenv = Dotenv\Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
        $dotenv->load();

        $server = $_ENV["DATA_BASE_SERVER"];
        $user = $_ENV["DATA_BASE_USER"];
        $password = $_ENV["DATA_BASE_PASSWORD"];
        $database = $_ENV["DATA_BASE_NAME"];

        echo getenv("DATA_BASE_SERVER");

        DataBase::$connection = new mysqli(
            $server,
            $user,
            $password,
            $database
        );

        if (DataBase::$connection->connect_error) {
            die("Не удалось подключиться к бд: " . DataBase::$connection->connect_error);
        }
    }

    private static function closeConnectToDataBase()
    {
        if (!DataBase::$connection) {
            return;
        }

        !DataBase::$connection->close();
        !DataBase::$connection = null;
    }

    public static function getRequest($sql)
    {
        if ($sql == "") {
            return;
        }

        if (!DataBase::$connection) {
            DataBase::connectToDataBase();
        }

        if (!DataBase::$connection) {
            return;
        }

        $result = DataBase::$connection->query($sql);

        DataBase::closeConnectToDataBase();

        return $result;
    }
}