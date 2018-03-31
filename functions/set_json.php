<?php
include_once ("get_json.php");
include_once ("auth.php");
function create_user ($login, $passwd, $isadmin)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_users_database();
    $array = array(
        "login" => $_POST["login"],
        "passwd" => hash_pw($_POST["passwd"]),
        "isadmin" => 0,
        "orders" => array()
    );
    $database["users"][] = $array;
    if (!file_put_contents(USERS_DATABASE, json_encode($database)))
        return false;
    return true;
}
?>