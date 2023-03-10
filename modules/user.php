<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/services/database.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/services/sessions.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/modules/value_converter.php");

class User
{
    private $id;
    private $login;

    public function __construct()
    {
        $this->id = Sessions::getSession("user_id");
        $this->login = Sessions::getSession("user_login");
    }

    public static function login($login, $password)
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
        $welcome = "Welcome, {$this->login} #{$this->id}!";
        echo "<h1>{$welcome}</h1>";
        echo ValueConverter::render();
        $this->renderLogout();
    }

    private function renderLogout()
    {
        echo '
            <form method="POST" action="">
                <input type="hidden" name="action" value="logout" />
                <input type="submit" value="Выход" />
            </form>
        ';
    }

    private function renderAuthorizationForm()
    {
        echo '
            <form method="POST" action="">
                <input type="hidden" name="action" value="login" />
                <p>
                    <label>Логин</label>
                    <input name="login" type="text" />
                </p>
                <p>
                    <label>Пароль</label>
                    <input name="password" type="password" />
                </p>
                <p>
                    <input type="submit" value="Авторизоваться" />
                </p>
            </form>
        ';
    }
}