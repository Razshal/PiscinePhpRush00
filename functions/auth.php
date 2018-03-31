<?php
function auth ($login, $passwd)
{
    $path = "../private";
    $file_name = $path . "/passwd";
    $array = unserialize(file_get_contents($file_name));
    $hash = hash ("sha512", $passwd);

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
}
?>