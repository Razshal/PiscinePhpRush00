<?php
$path = "../database";
$file_name = $path . "/users.json";
$success = false;

if (!($_POST["submit"] === "OK"
    && isset($_POST["login"]) && isset($_POST["passwd"])
    && $_POST["passwd"] != "" && $_POST["login"] != ""))
{
    $success = false;
}
else
{
    if (!file_exists($path))
        mkdir($path);
    if (!file_exists($file_name))
    {
        $array[] = array("login" => $_POST["login"],
                         "passwd" => hash("sha512", $_POST["passwd"]), "isadmin" => 0, "orders" => array());
        if (file_put_contents($file_name, json_encode($array)))
            $success = true;
    }
    else if (($file = file_get_contents($file_name)) != false)
    {
        $array = unserialize($file);
        foreach ($array as $subarray)
        {
            if ($subarray["login"] === $_POST["login"])
                $success = false;
        }
        $add_array = array("login" => $_POST["login"], "passwd" => hash("sha512", $_POST["passwd"]));
        $array[] = $add_array;
        if (file_put_contents($file_name, serialize($array)))
            $success = true;
    }
    else
        $success = false;
}
?>

<?php include "../site_structure/head.php"; ?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>

        <h1>le contenu de la page</h1>

        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>
