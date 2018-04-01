<?php include "../site_structure/head.php"; ?>

<?php
include_once "../functions/set_json.php";
$success = true;

if (!($_POST["submit"] === "OK"
        && isset($_POST["login"]) && isset($_POST["passwd"])
        && $_POST["passwd"] != "" && $_POST["login"] != ""))
    $success = false;
else
{
    if (!file_exists(USERS_DATABASE))
        create_user($_POST["login"], $_POST["passwd"], 0);
    else
    {
        $array = get_users_database();
        foreach ($array["users"] as $subarray)
        {
            if ($subarray["login"] === $_POST["login"])
            {
                $success = false;
                break;
            }
        }
        if ($success != false)
            $success = create_user($_POST["login"], $_POST["passwd"], 0);
    }
}
?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <?php include "../site_structure/sidemenu.php"; ?>
<div id="content">

        <h1>
            <?php
                if ($success === false)
                    echo "<p>Failed to sign you in, maybe this login already exists or your datas are incorrect.<p>";
                else
                    echo "<p>Your account has been created. You may now log in.<p>";
            ?>
        </h1>
    </div>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>
