<? require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/user.php") ?>

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