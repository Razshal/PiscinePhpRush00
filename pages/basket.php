<?php
include_once "../functions/set_json.php";
include_once "../functions/set_basket.php";
session_start();

if (isset($_POST["action"]) && $_POST["action"] === "Purchase"
    && isset($_SESSION["basket"]) && !empty($_SESSION["basket"]))
{
    if (!isset($_SESSION["logged_on_user"]) || $_SESSION["logged_on_user"] == "")
        header("location: /pages/login.php");
    else if (get_user($_SESSION["logged_on_user"])
        && create_order($_SESSION["logged_on_user"], $_SESSION["basket"]) === true)
    {
        destroy_basket();
        header("location: /pages/success_order.php");
    }
}

include "../site_structure/head.php";
$success = true;

if (isset($_POST["action"]) && $_POST["action"] === "Delete"
    && isset($_POST["product"]) && $_POST["product"] != ""
    && isset($_SESSION["basket"]))
{
    $success = delete_from_basket($_POST["product"]);
}

if (isset($_POST["action"]) && $_POST["action"] === "Update"
&& isset($_POST["product"]) && $_POST["product"] != ""
&& isset($_POST["qtty"]) && $_POST["qtty"] != "")
{
    if (is_numeric($_POST["qtty"]))
    {
        if ($_POST["qtty"] == 0)
            $success = delete_from_basket($_POST["product"]);
        else if ($_POST["qtty"] > 0)
            $success = update_basket($_POST["product"], $_POST["qtty"]);
    }
}
?>
<html>
    <body>
        <?php include "../site_structure/header.php";?>
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
                $total+= $item["price"] * $item["qtty"];
            ?>
                <tr>
                    <td><?php echo $item["name"];?></td>
                    <td><?php echo $item["price"];?></td>
                    <td>
                        <form method="post" action="basket.php" name="basket.php">
                            <input type="number" value="<?php echo $item["qtty"];?>" name="qtty">
                            <input type="hidden" name="product" value="<?php echo $item["name"];?>">
                            <input type="submit" name="action" value="Update">
                        </form>
                    </td>
                    <td>
                        <form method="post" action="basket.php" name="basket.php">
                            <input type="submit" name="action" value="Delete">
                            <input type="hidden" name="product" value="<?php echo $item["name"];?>">
                        </form>
                    </td>
                </tr>
            <?php
            }
        }?>
        </table>
        <h2>Total : <?php echo $total;?></h2>
        <?php if ($success === false) echo "<h3>Error</h3>";?>
        <form method="post" action="basket.php" name="basket.php">
            <input type="submit" name="action" value="Purchase">
        </form>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>

<?php unset($_POST); ?>