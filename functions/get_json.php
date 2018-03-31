<?php
define("PATH", "../database");
define("USERS_DATABASE", PATH . "/users.json");

function get_users_database()
{
    return json_decode(file_get_contents(USERS_DATABASE),true);
}