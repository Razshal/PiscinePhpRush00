<?php include "../site_structure/head.php"; ?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <h1>Your Basket</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        <?php
        $total = 0;
        if (isset($_SESSION["basket"]))
        {
            foreach ($_SESSION["basket"] as $item)
            {
                $total+= $item["price"];
            ?>
                <tr>
                    <td><?php echo $item["name"];?></td>
                    <td><?php echo $item["price"];?></td>
                    <td><?php echo $item["qtty"];?></td>
                    <td>
                        <form method="post" action="basket.php" name="basket.php">
                            <input type="button" name="<?php echo $item["name"]; ?>" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php
            }
        } ?>
        </table>
        <h2>Total : <?php echo $total;?></h2>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>