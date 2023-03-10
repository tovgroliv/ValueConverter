<?php

/**
 * Класс работы с данными сессии.
 */
class Sessions
{
    /**
     * @param Id $id
     * @param string $status
     */
    private static function sessionStart()
    {
        session_start();
    }

    /**
     * Установка значение элемента сессии. 
     * 
     * @param $name string
     * @param $value string
     */
    public static function setSession($name, $value)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION[$name] = $value;
    }

    /**
     * Получение значения сессии. 
     * 
     * @param $name string
     */
    public static function getSession($name)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION[$name];
    }

    /**
     * Сброс значения элемента сессии. 
     * 
     * @param $name string
     */
    public static function unsetSession($name)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION[$name]);
    }
}