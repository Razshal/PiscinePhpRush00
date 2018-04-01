<?php
include_once ("get_json.php");
include_once ("auth.php");

function create_user ($login, $passwd, $isadmin = 0)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_users_database();
    $array = array(
        "login" => $login,
        "passwd" => hash_pw($passwd),
        "isadmin" => $isadmin
    );
    $database["users"][] = $array;
    if (!file_put_contents(USERS_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}
function delete_user ($login)
{
    $done = false;
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_users_database();
    foreach ($database["users"] as &$user)
    {
        if ($user["login"] === $login)
        {
            $temp = $database["users"][0];
            $database["users"][0] = $user;
            $user = $temp;
            array_shift($database["users"]);
            $done = true;
            break;
        }
    }
    array_values($database["users"]);
    delete_all_user_orders($login);
    if ($done === false ||
        !file_put_contents(USERS_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}
function alter_user($login, $oldpw, $newpw, $isadmin = 0)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_users_database();
    foreach ($database["users"] as &$user)
    {
        if ($user["login"] === $login)
        {
            if ($user["passwd"] === hash_pw($oldpw))
            {
                $user["passwd"] = hash_pw($newpw);
                if (!file_put_contents(USERS_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
                    return false;
                break;
            }
            $user["isadmin"] = $isadmin;
        }
    }
    return true;
}

function create_product ($name, $category, $price, $image)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_product_database();
    $list = array(
        "name" => $name,
        "category" => $category,
        "price" => $price,
        "image" => $image
    );
    $database["products"][] = $list;
    if (!file_put_contents(PRODUCT_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}
function delete_product ($name)
{
    $done = false;
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_product_database();
    foreach ($database["products"] as &$prod)
    {
        if ($prod["name"] === $name)
        {
            $temp = $database["products"][0];
            $database["products"][0] = $prod;
            $prod = $temp;
            array_shift($database["products"]);
            $done = true;
            break;
        }
    }
    array_values($database["products"]);
    if ($done === false ||
        !file_put_contents(PRODUCT_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}
function alter_product($name, $category, $price, $image)
{
    $done = false;
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_product_database();
    foreach ($database["products"] as &$item)
    {
        if ($item["name"] === $name)
        {
            $item["name"] = $name;
            $item["price"] = $price;
            $item["image"] = $image;
            $item["category"] = $category;
            if ($done === false
                || !file_put_contents(PRODUCT_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
                return false;
            break;
        }
    }
    return true;
}

function create_category ($category)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_categories_database();
    $list = array("name" => $category);
    $database["categories"][] = $list;
    if (!file_put_contents(CAT_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}
function alter_category ($category, $category_new_name)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_categories_database();
    $prod_database = get_product_database();
    foreach ($database["categories"] as &$cat)
    {
        if ($cat["name"] === $category)
        {
            $cat["name"] = $category_new_name;
            if (!file_put_contents(CAT_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
                return false;
            foreach ($prod_database["products"] as &$prod)
            {
                foreach ($prod["category"] as &$catstr)
                {
                    if ($catstr === $category)
                        $catstr = $category_new_name;
                    alter_product($prod["name"], $prod["category"], $prod["price"], $prod["image"]);
                }
            }
            break;
        }
    }
    return true;
}

function create_order ($login, $basket)
{
    if (!isset($basket) || empty($basket))
        return false;
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_order_database();
    $database["orders"][$login][] = $basket;
    if (!file_put_contents(ORDER_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}
function delete_order ($login, $order)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_order_database();
    if (!isset($database["orders"][$login][0]) || !isset($database["orders"][$login][$order]))
        return false;
    $temp = $database["orders"][$login][0];
    $database["orders"][$login][0] = $database["orders"][$login][$order];
    $database["orders"][$login][$order] = $temp;
    array_shift($database["products"][$login]);
    array_values($database["products"][$login]);
    if (!file_put_contents(ORDER_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}
function delete_all_user_orders ($login)
{
    if (!file_exists(PATH))
        mkdir(PATH);
    $database = get_order_database();
    if (!isset($database["orders"][$login]))
        return false;
    unset($database["orders"][$login]);
    if (!file_put_contents(ORDER_DATABASE, json_encode($database, JSON_PRETTY_PRINT)))
        return false;
    return true;
}
?>