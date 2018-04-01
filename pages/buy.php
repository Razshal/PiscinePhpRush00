<?php
include "../site_structure/head.php";
include_once "../functions/get_json.php";
include_once "../functions/set_json.php";
include_once "../functions/set_basket.php";

$page = $_POST["page"];
$page_num = $_POST["page_num"];

if (isset($_POST["submit"]) && $_POST["submit"] === "add"
    && isset($_POST["product"]) && $_POST["product"] != "")
    add_to_basket($_POST["product"]);
if (!isset($page_num) || !is_numeric($page_num) || $page_num === "")
    $page_num = 0;
else if ($page === "next")
    $page_num++;
else if ($page === "previous")
    $page_num--;
if ($page_num < 0)
    $page_num = 0;
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
                <th>Add to basket</th>
            </tr>
            <?php
            $items_per_page = 10;
            if (isset($_GET["categories"]) && $_GET["categories"] != "")
            {
                $count = 0;
                $items = get_product_database();
                if (isset($page_num) && is_numeric($page_num))
                    $start = $page_num * $items_per_page;
                else
                    $start = 0;
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
                                <input type="submit" name="submit" value="add">
                                <input type="hidden" name="product" value="<?php echo $product["name"]; ?>">
                            </form>
                        </td>
                    </tr><?php
                    }
                    $count++;
                    if (($count - $start) >= $items_per_page)
                        break;
                }
            }
            else
            {
                $count = 0;
                $items = get_product_database();
                if (isset($page_num) && is_numeric($page_num))
                    $start = $page_num * $items_per_page;
                else
                    $start = 0;
                foreach ($items["products"] as $product) {
                    if ($count >= $start)
                    {
                        ?>
                        <tr>
                            <td><img src="<?php echo $product["image"] ?>"/></td>
                            <td><?php echo $product["name"] ?></td>
                            <td><?php echo $product["price"] ?></td>
                        <td>
                            <form method="post" action="buy.php" name="buy.php">
                                <input type="submit" name="submit" value="add"/>
                                <input type="hidden" name="product" value="<?php echo $product["name"]; ?>"/>
                            </form>
                        </td>
                        </tr><?php
                    }
                    $count++;
                    if (($count - $start) >= $items_per_page)
                        break;
                }
            }
                ?>
            <form method="post" action="buy.php" name="buy.php">
                <input type="submit" name="page" value="next"/>
                <input type="submit" name="page" value="previous"/>
                <input type="hidden" name="page_num" value="<?php echo $page_num ?>"/>
            </form>
        </table>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>