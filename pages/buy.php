<?php include "../site_structure/head.php"; ?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>

        <h1>Our products</h1>
        <form method="get" action="buy.php" name="buy.php">
            <select multiple name="Categories" title="Categories">
                <?php
                $categories = get_categories_database();
                foreach ($categories as $category)
                {?>
                <option value="<?php echo $category["name"];?>><?php echo $category["name"];?></option>
                <?php
                }?>
            </select>
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