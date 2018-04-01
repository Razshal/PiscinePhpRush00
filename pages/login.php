<?php
include_once "../site_structure/head.php";
include_once "../functions/auth.php";

if (isset($_POST["login"]) && isset($_POST["passwd"])
    && auth($_POST["login"], $_POST["passwd"]) === true)
    $_SESSION["logged_on_user"] = $_POST["login"];
else
{
    $_SESSION["logged_on_user"] = "";
    $_SESSION["admin"] = "";
    session_destroy();
}
if (get_user($_SESSION["logged_on_user"])["isadmin"] == 1)
    $_SESSION["admin"] = 1;
$logged_user = (isset($_SESSION["logged_on_user"]) && $_SESSION["logged_on_user"] != "");
?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <?php
        if (!$logged_user)
        {
            ?>
            <div id="loginForm">
                <h1>Login</h1>
                <form method="post" action="login.php" name="login.php">
                    Identifiant: <input type="text" name="login"/>
                    <br/>
                    Mot de passe: <input type="password" name="passwd"/>
                    <input type="submit" name="submit" value="OK"/>
                </form>
            </div>
        <?php
        }
        else
            echo "<h1>Logged in as {$_SESSION["logged_on_user"]}</h1>";
        ?>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>
