<? require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/user.php") ?>

<?php
if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "logout":
            User::logout();
            break;
        case "login":
            User::login($_POST["login"], $_POST["password"]);
            break;
    }
}
?>

<html>

<head>
    <title>ValueConverter</title>
</head>

<body>
    <?php
    $user = new User();

    $user->render();
    ?>
</body>

</html>