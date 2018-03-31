<?php
include "../site_structure/head.php";
include "../functions/get_json.php";


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
                <th>Name</th>
                <th>Name</th>
                <th>Name</th>
            </tr>
        </table>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>