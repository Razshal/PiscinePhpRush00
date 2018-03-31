<?php
include "../functions/set_json.php";
$success = true;

if (!($_POST["submit"] === "OK"
    && isset($_POST["login"]) && isset($_POST["passwd"])
    && $_POST["passwd"] != "" && $_POST["login"] != ""))
{
    $success = false;
}
else
{
    if (!file_exists(USERS_DATABASE))
        create_user($_POST["login"], $_POST["passwd"], 0);
    else
    {
        $array = get_users_database();
        foreach ($array as $subarray)
        {
            if ($subarray["login"] === $_POST["login"])
            {
                $success = false;
                break;
            }
        }
        if ($success === true)
            $success = create_user($_POST["login"], $_POST["passwd"], 0);
    }
}
?>

<?php include "../site_structure/head.php"; ?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>

        <p>
            <?php
                if ($success === false)
                    echo "Failed to sign you in, maybe the account already exists or your datas are incorrect";
                else
                    echo "Your account has been created";
            ?>
        </p>

        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>
