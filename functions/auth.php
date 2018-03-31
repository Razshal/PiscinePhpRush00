<?php
function hash_pw($passwd)
{
    return hash ("whirlpool", $passwd);
}
function auth ($login, $passwd)
{
    $path = "../database";
    $file_name = $path . "/users.csv";
    $file = fopen($file_name, "r");
    $array = unserialize(file_get_contents($file_name));
    $hash = hash_pw($passwd);

    foreach ($array as &$subarray)
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