<?php
include "../site_structure/head.php";
include_once "../functions/set_json.php";
$success = true;
$created = true;


if (!($_POST["submit"] === "Create account"
    && isset($_POST["login"]) && isset($_POST["passwd"])
    && $_POST["passwd"] != "" && $_POST["login"] != ""))
    $success = false;
else if (!get_user($_POST["login"]) && !is_there_any_admin())
    $created = create_user($_POST["login"], $_POST["passwd"], 1);
?>

<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
    <?php
    if (!is_there_any_admin())
    {?>
        <h1>Welcome to your first run of the webiste</h1>
        <h2>Please set a first Superadmin account</h2>
        <form method="post" action="install.php" name="install.php">
            Identifiant: <input type="text" name="login"/>
            <br/>
            Mot de passe: <input type="password" name="passwd"/>
            <input type="submit" name="submit" value="Create account"/>
        </form>
        <?php
    }
    else if (!$created)
        echo "<h1 id=\"error\">error</h1>";
    else
    {?>
        <h1>The setup has already been done</h1>
    <?php
    }?>
            <?php include "../site_structure/footer.php"; ?>
    </body>
</html>
