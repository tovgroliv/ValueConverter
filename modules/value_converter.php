<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/services/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/services/sessions.php");

class ValueConverter
{
    private static $values_url = "http://www.cbr.ru/scripts/XML_daily.asp";

    public $id;
    public $char_code;
    public $nominal;
    public $name;
    public $value;
    
    public function __construct($id, $char_code, $nominal, $name, $value)
    {
        $this->id = $id;
        $this->char_code = $char_code;
        $this->nominal = $nominal;
        $this->name = $name;
        $this->value = $value;
    }

    public static function getAllValue()
    {
        $result = DataBase::getRequest("SELECT * FROM `Value`");
        $return = array();
        
        if ($result)
        {
            while ($row = mysqli_fetch_array($result))
            {
                $return[$row["id"]] = new ValueConverter($row["id"], $row["char_code"], $row["nominal"], $row["name"], $row["value"]);
            }
        }

        return $return;
    }

    public static function updateAllValue()
    {
        $url = ValueConverter::$values_url;
        $xml = simplexml_load_file($url);

        if ($xml === false)
        {
            return;
        }

        DataBase::getRequest("DELETE FROM `Value`");
        
        $json = json_encode($xml);
        $values = json_decode($json, TRUE);

        foreach ($values["Valute"] as $key => $value)
        {
            $double = str_replace(",", ".",  $value["Value"]);
            $sql = "INSERT INTO `Value` (`id`, `char_code`, `nominal`, `name`, `value`) VALUES ('{$value["@attributes"]["ID"]}', '{$value["CharCode"]}', '{$value["Nominal"]}', '{$value["Name"]}', '{$double}')";
            DataBase::getRequest($sql);
        }
    }

    public function valueFrom($amount)
    {
        if ($amount == 0)
        {
            return 0;
        }
        return $this->value / $amount * $this->nominal;
    }

    public function valueTo($amount)
    {
        return $amount * $this->nominal / $this->value;
    }
}