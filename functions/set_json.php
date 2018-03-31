<?php
include_once ("get_json.php");
include_once ("auth.php");
function create_user ($login, $passwd, $isadmin)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_users_database();
    $array = array(
        "login" => $login,
        "passwd" => hash_pw($passwd),
        "isadmin" => 0,
        "orders" => array()
    );
    $database["users"][] = $array;
    if (!file_put_contents(USERS_DATABASE, json_encode($database)))
        return false;
    return true;
}

function create_product ($name, $category, $price, $image, $id)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_product_database();
    $list = array(
        "name" => $name,
        "category" => $category,
        "price" => $price,
        "image" => $image,
        "id" => $id
    );
    $database["product"][] = $list;
    if (!file_put_contents(PRODUCT_DATABASE, json_encode($database)))
        return false;
    return true;
}
?>