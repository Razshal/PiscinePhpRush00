<?php
function add_to_basket($product)
{
    $real_product = get_product($product);
    if (!isset($_SESSION["basket"]))
        $_SESSION["basket"] = array();
    foreach ($_SESSION["basket"] as &$item)
    {
        if ($item["name"] === $product)
        {
            if (!isset($item["qtty"]))
                $item["qtty"] = 1;
            else
                $item["qtty"]++;
            return true;
        }
    }
    if ($real_product != NULL)
    {
        $real_product["qtty"] = 1;
        $_SESSION["basket"][] = $real_product;
        return true;
    }
    else
        return false;
}
function update_basket($product, $qtty)
{
    if (!isset($_SESSION["basket"]))
        return false;
    foreach ($_SESSION["basket"] as &$item)
    {
        if ($item["name"] === $product)
        {
            $item["qtty"] = $qtty;
            return true;
        }
    }
    return false;
}
function delete_from_basket($product)
{
    if (!isset($_SESSION["basket"]))
        return false;
    foreach ($_SESSION["basket"] as &$item)
    {
        if (isset($item["name"]) && $item["name"] === $product)
        {
            $temp = $_SESSION["basket"][0];
            $_SESSION["basket"][0] = $item;
            $item = $temp;
            array_shift($_SESSION["basket"]);
            array_values($_SESSION["basket"]);
            return true;
        }
    }
    return false;
}
function destroy_basket()
{
    if (isset($_SESSION["basket"]))
        unset($_SESSION["basket"]);
}