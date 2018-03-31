<?php
include "../site_structure/head.php";
include_once "../functions/set_json.php";

if (isset($_POST["action"]) && $_POST["action"] === "Delete"
    && isset($_POST["product"]) && $_POST["product"] != "")
{
 //   var_dump($_SESSION["basket"]);
    var_dump($_POST);
    if (isset($_SESSION["basket"]["product"]))
        $_SESSION["basket"] = delete_from_array($_POST["product"], $_SESSION["basket"]);
}

?>
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
                            <input type="submit" name="action" value="Delete">
                            <input type="hidden" name="product" value="<?php echo $item["name"];?>">
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