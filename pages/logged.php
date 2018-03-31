<?php
include ("../functions/auth.php");
session_start();
if (auth($_GET["login"], $_GET["passwd"]) === true)
{
    $_SESSION["logged_on_user"] = $_GET["login"];
}
else
{
    $_SESSION["logged_on_user"] = "";
}
?>


<?php
include "../site_structure/head.php"; ?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <h1>
            <?php
            if (!isset($_SESSION["logged_on_user"]) || $_SESSION["logged_on_user"] == "")
                echo "Logged out";
            else
                echo "Logged in as {$_SESSION["logged_on_user"]}";
            ?>
        </h1>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>
