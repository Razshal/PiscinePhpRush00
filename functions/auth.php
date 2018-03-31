<?php
include_once "get_json.php";

function hash_pw($passwd)
{
    return hash ("whirlpool", $passwd);
}
function auth ($login, $passwd)
{
    $array = get_users_database();
    $hash = hash_pw($passwd);
    var_dump($array);
    foreach ($array["users"] as $subarray)
    {
        if ($subarray["login"] === $login)
        {
            if ($subarray["passwd"] === $hash)
                return (true);
            else
                return (false);
        }
    }
    return (false);
}
?>