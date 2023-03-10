<?php

class Sessions
{
    private static function sessionStart()
    {
        session_start();
    }

    public static function setSession($name, $value)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION[$name] = $value;
    }

    public static function getSession($name)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION[$name];
    }

    public static function unsetSession($name)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION[$name]);
    }
}