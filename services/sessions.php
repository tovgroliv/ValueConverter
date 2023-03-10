<?php

class Sessions
{    
    private static function sessionStart()
    {
        session_start();
    }

    public static function getSession($name)
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
        
        return $_SESSION[$name];
    }
}