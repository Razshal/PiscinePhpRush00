<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>La boutique</title>
</head>
<body>
    <header>
        <nav>
            <a href="#">Home</a>
            <a href="#">Browse Products</a>
            <a href="#">Login</a>
            <?php
            if ($_SESSION["logged_on_user"] != "")
                echo "<a href=\"#\">Logout</a>"

                ?>

        </nav>
    </header>
</body>