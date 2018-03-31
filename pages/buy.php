<?php
include "../site_structure/head.php";
include "../functions/get_json.php";

if (isset($_GET["categories"]) && $_GET["categories"] != "")
{
    //wip
    echo ("This button is under construction");
}
if (isset($_POST["submit"]) && $_POST["submit"] === "add"
    && isset($_POST["product"]) && $_POST["product"] != ""
    && ($product = get_product($_POST["product"])))
{
    if (!isset($_SESSION["basket"]))
        $_SESSION["basket"] = array();
    $_SESSION["basket"][] = $product;
}
?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <h1>Our products</h1>
        <form method="get" action="buy.php" name="buy.php">
            <select name="categories" title="categories">
                <option value="">No filter</option>
                <?php
                $categories = get_categories_database();
                foreach ($categories["categories"] as $cat)
                {?>
                    <option value="<?php echo ($cat["name"]);?>">
                        <?php echo ($cat["name"]);?>
                    </option><?php
                }?>
            </select>
            <input type="submit" value="Filter">
        </form>
        <table>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
            <?php
            $items_per_page = 10;
            if (isset($_GET["categories"]) && $_GET["categories"] != "")
            {
                $count = 0;
                $items = get_product_database();
                foreach ($items["products"] as $product)
                {
                    if (in_array($_GET["categories"], $product["category"], true))
                    {
                        $count++;
                        ?>
                    <tr>
                        <td><img src="<?php echo $product["image"]?>"/></td>
                        <td><?php echo $product["name"]?></td>
                        <td><?php echo $product["price"]?></td>
                        <td>
                            <form method="post" action="buy.php" name="buy.php">
                                <input type="submit" name="add" value="<?php echo $product["name"]; ?>">
                            </form>
                        </td>
                    </tr><?php
                    }
                    if ($count >= $items_per_page)
                        break;
                }
            }
            else
            {
                $count = 0;
                $items = get_product_database();
                foreach ($items["products"] as $product) {
                    $count++;
                    ?>
                    <tr>
                    <td><img src="<?php echo $product["image"] ?>"/></td>
                    <td><?php echo $product["name"] ?></td>
                    <td><?php echo $product["price"] ?></td>
                    <td>
                        <form method="post" action="buy.php" name="buy.php">
                            <input type="submit" name="submit" value="add">
                            <input type="hidden" name="product" value="<?php echo $product["name"]; ?>">
                        </form>
                    </td>
                    </tr><?php
                    if ($count >= $items_per_page)
                        break;
                }
            }
                ?>
        </table>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>