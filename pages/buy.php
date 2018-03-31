<?php
include "../site_structure/head.php";
include "../functions/get_json.php";

if (isset($_GET["categories"]) && $_GET["categories"] != "")
{
    //wip
    echo ("This button is under construction");
}
?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <h1>Our products</h1>
        <form method="get" action="buy.php" name="buy.php">
            <select name="categories" title="categories">
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
                {?>
                    <tr>
                        <td><?php echo $product["image"]?></td>
                        <td><?php echo $product["name"]?></td>
                        <td><?php echo $product["price"]?></td>
                    </tr><?php
                }
            }?>
        </table>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>