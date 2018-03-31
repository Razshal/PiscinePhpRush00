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
    if (!file_put_contents(USERS_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}
function delete_user ($login)
{
    $done = false;

    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_users_database();
    foreach ($database["users"] as &$user)
    {
        if ($user["login"] === $login)
        {
            $temp = $database["users"][0];
            $database["users"][0] = $user;
            $user = $temp;
            array_shift($database["users"]);
            break;
        }
    }
    array_values($database["users"]);
    $done = true;
    if ($done === false ||
        !file_put_contents(USERS_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
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
        "image" => $image
    );
    $database["products"][] = $list;
    if (!file_put_contents(PRODUCT_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}
function delete_product ($name)
{
    $done = false;

    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_users_database();
    foreach ($database["products"] as &$prod)
    {
        if ($prod["name"] === $name)
        {
            $temp = $database["products"][0];
            $database["products"][0] = $prod;
            $prod = $temp;
            array_shift($database["products"]);
            break;
        }
    }
    array_values($database["products"]);
    $done = true;
    if ($done === false ||
        !file_put_contents(USERS_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}

function create_category ($category)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_product_database();
    $list = array("name" => $category);
    $database["categories"][] = $list;
    if (!file_put_contents(CAT_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}

function add_to_basket($product)
{
    $real_product = get_product($product);
    if (!isset($_SESSION["basket"]))
        $_SESSION["basket"] = array();
    foreach ($_SESSION["basket"] as &$item)
    {
       if ($item["name"] === $product)
       {
           if (!isset($item["qtty"]))
               $item["qtty"] = 1;
           else
               $item["qtty"]++;
           return true;
       }
    }
    if ($real_product != NULL)
    {
        $real_product["qtty"] = 1;
        $_SESSION["basket"][] = $real_product;
        return true;
    }
    else
        return false;
}
function update_basket($product, $qtty)
{
    if (!isset($_SESSION["basket"]))
        return false;
    foreach ($_SESSION["basket"] as &$item)
    {
        if ($item["name"] === $product)
        {
            $item["qtty"] = $qtty;
            return true;
        }
    }
    return false;
}
function delete_from_basket($product)
{
    if (!isset($_SESSION["basket"]))
        return false;
    foreach ($_SESSION["basket"] as &$item)
    {
        if (isset($item["name"]) && $item["name"] === $product)
        {
            $temp = $_SESSION["basket"][0];
            $_SESSION["basket"][0] = $item;
            $item = $temp;
            array_shift($_SESSION["basket"]);
            array_values($_SESSION["basket"]);
            return true;
        }
    }
    return false;
}
?>