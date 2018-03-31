<?php
include "get_json.php";

function hash_pw($passwd)
{
    return hash ("whirlpool", $passwd);
}
function auth ($login, $passwd)
{

    $array = json_decode(file_get_contents(USERS_DATABASE),true);
    $hash = hash_pw($passwd);
    var_dump($array);
    foreach ($array["users"] as &$subarray)
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