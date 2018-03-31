<?php
define("PATH", "../database");
define("USERS_DATABASE", PATH . "/users.json");
define("PRODUCT_DATABASE", PATH . "/products.json");

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
?>