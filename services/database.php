<?php

class DataBase
{
    private static $server = "127.0.0.1";
    private static $user = "root";
    private static $password = "";
    private static $database = "ValueConverter";
    
    private static $connection;
    
    private static function connectToDataBase()
    {
        DataBase::$connection = new mysqli(
            DataBase::$server,
            DataBase::$user,
            DataBase::$password,
            DataBase::$database);

        if (DataBase::$connection->connect_error) {
            die("Не удалось подключиться к бд: " . DataBase::$connection->connect_error);
        }
    }

    public static function getRequest($sql)
    {
        if ($sql == "")
        {
            return;
        }

        if (!DataBase::$connection)
        {
            DataBase::connectToDataBase();
        }

        $result = DataBase::$connection->query($sql);
        
        return $result;
    }
}