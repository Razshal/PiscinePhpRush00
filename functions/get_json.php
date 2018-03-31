<?php
define("PATH", "../database");
define("USERS_DATABASE", PATH . "/users.json");
define("PRODUCT_DATABASE", PATH . "/products.json");
define("CAT_DATABASE", PATH . "/categories.json");

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
function get_user($name)
{
    if (file_exists(USERS_DATABASE))
        $database = json_decode(file_get_contents(USERS_DATABASE), true);
    else
        return NULL;
    foreach ($database["users"] as $user)
    {
        if ($user === $name)
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
    if (file_exists(CAT_DATABASE))
        $database = json_decode(file_get_contents(CAT_DATABASE), true);
    else
        return NULL;
    foreach ($database["products"] as $cat)
    {
        if ($cat === $name)
            return $cat;
    }
    return NULL;
}
?>