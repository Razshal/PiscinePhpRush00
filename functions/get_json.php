<?php
define("PATH", "../database");
define("USERS_DATABASE", PATH . "/users.json");

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