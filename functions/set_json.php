<?php
include ("get_json.php");
include ("auth.php");
function create_user ($login, $passwd, $isadmin)
{
    $database = get_users_database();
    $array[] = array(
        "login" => $_POST["login"],
        "passwd" => hash_pw($_POST["passwd"]),
        "isadmin" => 0,
        "orders" => array()
    );
    array_push($database["users"], $array);
    if (!file_put_contents(json_encode($database), USERS_DATABASE))
        return false;
    return true;
}