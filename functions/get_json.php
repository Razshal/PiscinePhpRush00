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
        if ($prod === $name)
            return $prod;
    }
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
?>