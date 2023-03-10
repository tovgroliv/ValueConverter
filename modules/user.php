<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/services/database.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/services/sessions.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/modules/value_converter.php");

/**
 * Класс пользователя.
 */
class User
{
    /**
     * Идентификатор пользователя.
     * 
     * @var int
     */
    private $id;
    /**
     * Логин пользователя.
     * 
     * @var string
     */
    private $login;

    /**
     * Конструктор.
     */
    public function __construct()
    {
        $this->id = Sessions::getSession("user_id");
        $this->login = Sessions::getSession("user_login");
    }

    /**
     * Авторизация пользователя.
     * 
     * @param string $login
     * @param string $password
     */
    public static function login($login, $password)
    {
        if (!isset($login, $password))
            return;

        $password = md5($password);
        $result = DataBase::getRequest("SELECT `id`,`login` FROM `User` WHERE `login`='{$login}' AND `password`='{$password}'");

        if (!$result) {
            return;
        }

        while ($row = mysqli_fetch_array($result)) {
            if (isset($row["id"]))
                Sessions::setSession("user_id", $row["id"]);
            if (isset($row["login"]))
                Sessions::setSession("user_login", $row["login"]);
        }
    }

    /**
     * Выход пользователя.
     */
    public static function logout()
    {
        Sessions::unsetSession("user_id");
        Sessions::unsetSession("user_login");
    }

    /**
     * Проверка авторизации.
     * 
     * @todo Сохранение случайного значения для сессии в бд и сравнение его из сессии.
     * @return bool
     */
    public function logined()
    {
        $logined = isset($this->id, $this->login);
        return $logined;
    }

    /**
     * Оторажение UI.
     */
    public function render()
    {
        if ($this->logined()) {
            $this->renderUserControlPanel();
        } else {
            $this->renderAuthorizationForm();
        }
    }
    
    /**
     * Оторажение UI личного кабинета.
     */
    private function renderUserControlPanel()
    {
        $welcome = "Welcome, {$this->login} #{$this->id}!";
        echo "<h1>{$welcome}</h1>";
        echo ValueConverter::render();
        $this->renderLogout();
    }

    /**
     * Оторажение UI выхода.
     */
    private function renderLogout()
    {
        echo '
            <form method="POST" action="">
                <input type="hidden" name="action" value="logout" />
                <input type="submit" value="Выход" />
            </form>
        ';
    }

    /**
     * Оторажение UI формы входа.
     */
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