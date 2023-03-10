<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/services/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/services/sessions.php");

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/value_converter.php");

class User
{
    private $id;
    private $login;

    public function __construct()
    {
        $this->id = Sessions::getSession("user_id");
        $this->login = Sessions::getSession("user_login");
    }

    public static function authorize($login, $password)
    {
        $password = md5($password);
        $result = DataBase::getRequest("SELECT `id`,`login` FROM `User` WHERE `login`='{$login}' AND `password`='{$password}'");
        
        if ($result)
        {
            while ($row = mysqli_fetch_array($result))
            {
                if (isset($row["id"])) Sessions::setSession("user_id", $row["id"]);
                if (isset($row["login"])) Sessions::setSession("user_login", $row["login"]);
            }
        }
    }

    public static function logout()
    {
        Sessions::unsetSession("user_id");
        Sessions::unsetSession("user_login");
    }

    public function logined()
    {
        $logined = isset($this->id, $this->login);
        return $logined;
    }

    public function render()
    {
        if ($this->logined())
        {
            $this->renderUserControlPanel();
        }
        else
        {
            $this->renderAuthorizationForm();
        }
    }
    private function renderUserControlPanel()
    {
        $select = "";
        $values = ValueConverter::getAllValue();
        foreach ($values as $key => $value) {
            $selected = $_GET["valueId"] === $key ? "selected" : "";
            $select .= "<option value='{$key}' {$selected}>{$value->name}</option>";
        }

        $welcome = "Welcome, {$this->login} #{$this->id}!";

        $valueTo = 0;
        $valueFrom = 0;

        if (isset($_GET["valueTo"]) && isset($_GET["valueId"]))
        {
            $valueTo = $values[$_GET["valueId"]]->valueTo($_GET["valueTo"]);
        }
        if (isset($_GET["valueFrom"]) && isset($_GET["valueId"]))
        {
            $valueFrom = $values[$_GET["valueId"]]->valueFrom($_GET["valueFrom"]);
        }

        echo "
            <h1>{$welcome}</h1>
            <form method='get'>
                <p>
                    <label>Рублей в валюте</label>
                    <input name='valueFrom' type='number' value='{$_GET["valueFrom"]}' />
                    <label>{$valueFrom}</label>
                </p>
                <p>
                    <label>Валютсы в рублях </label>
                    <input name='valueTo' type='number' value='{$_GET["valueTo"]}' />
                    <label>{$valueTo}</label>
                </p>
                <p>
                    <label>Валюта для конвертации</label>
                    <select name='valueId'>{$select}</select>
                </p>
                <p>
                    <input type='submit' value='Перевести' />
                </p>
            </form>
            <form method='post' action='services/post/logout.php'>
                <input type='submit' value='Выход' />
            </form>
        ";
    }

    private function renderAuthorizationForm()
    {
        echo '
            <form metod="post" action="services/post/login.php">
                <p>
                    <label>Логин</label>
                    <input name="login" type="text" />
                </p>
                <p>
                    <label>Пароль</label>
                    <input name="password" type="password" />
                </p>
                <p>
                    <input type="submit" value="авторизоваться" />
                </p>
            </form>
        ';
    }
}