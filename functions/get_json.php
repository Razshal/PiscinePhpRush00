<?php
define("PATH", "../database");
define("USERS_DATABASE", PATH . "/users.json");
define("PRODUCT_DATABASE", PATH . "/products.json");
define("CAT_DATABASE", PATH . "/categories.json");
define("ORDER_DATABASE", PATH . "/orders.json");

function get_users_database()
{
    if (file_exists(USERS_DATABASE))
        return json_decode(file_get_contents(USERS_DATABASE),true);
    else
    {
        $array = array();
        $array["users"] = array();
        return $array;
    }
}
function get_user($login)
{
    $database = get_users_database();
    foreach ($database["users"] as $user)
    {
        if ($user["login"] === $login)
            return $user;
    }
    return NULL;
}

function get_product_database()
{
    if (file_exists(PRODUCT_DATABASE))
        return json_decode(file_get_contents(PRODUCT_DATABASE), true);
    else
    {
        $list = array();
        $list["products"] = array();
        return $list;
    }
}
function get_product($name)
{
    if (file_exists(PRODUCT_DATABASE))
        $database = json_decode(file_get_contents(PRODUCT_DATABASE), true);
    else
        return NULL;
    foreach ($database["products"] as $prod)
    {
        if ($prod["name"] === $name)
            return $prod;
    }
    return NULL;
}

function get_categories_database()
{
    if (file_exists(CAT_DATABASE))
        return json_decode(file_get_contents(CAT_DATABASE), true);
    else
    {
        $list = array();
        $list["categories"] = array();
        return $list;
    }
}
function get_category($name)
{
    $database = get_categories_database();
    foreach ($database["categories"] as $cat)
    {
        if ($cat === $name)
            return $cat;
    }
    return NULL;
}

function get_order_database()
{
    if (file_exists(ORDER_DATABASE))
        return json_decode(file_get_contents(ORDER_DATABASE),true);
    else
    {
        $array = array();
        $array["orders"] = array();
        return $array;
    }
}
function get_order($login, $order_num)
{
    $database = get_order_database();
    foreach ($database["categories"] as $cat)
    {
        if ($cat === $login)
        {
            if (isset($cat[$login][$order_num]) && !empty($cat[$login][$order_num]))
                return $cat[$login][$order_num];
            else
                return NULL;
        }
    }
    return NULL;
}
function get_client_orders($login)
{
    $database = get_order_database();
    $orders = $database["orders"][$login];
    if (isset($orders) && !empty($orders))
        return $orders;
    else
        return NULL;
}
?>