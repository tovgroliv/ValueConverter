<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/user.php");

User::authorize($_GET["login"], $_GET["password"]);
