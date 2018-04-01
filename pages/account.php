<?php
include_once "../site_structure/head.php";
include_once "../functions/set_json.php";
include_once "../functions/get_json.php";
$user_has_been_deleted = true;
if (auth($_SESSION["logged_on_user"], $_POST["passwd"]) === true)
{
    $user_has_been_deleted = delete_user($_SESSION["logged_on_user"]);
    $_SESSION["logged_on_user"] = "";
}
$logged_user = (isset($_SESSION["logged_on_user"]) && $_SESSION["logged_on_user"] != "");
?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <?php if ($logged_user === true || $user_has_been_deleted === false)
        {?>
        <h1>Hello <?php echo $_SESSION["logged_on_user"] ?></h1>
        <h2>Here you can manage your account</h2>
        <form method="post" action="account.php" name="account.php">
            Confirm your password for deletion: <input type="password" name="passwd"/>
            <input type="submit" name="submit" value="Delete my account"/>
        </form>
        <?php
        }
        else
        {?>
        <h1>You have no account</h1> <?php
        }
        if ($logged_user === true
            && ($orders = get_client_orders($_SESSION["logged_on_user"])) != NULL)
        {
            $order_num = 0;
            foreach ($orders as $order)
            {
                ?>
                <h3>Order No <?php echo $order_num++ ?></h3>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Cat</th>
                        <th>Price</th>
                        <th>Qtty</th>
                    </tr>
                <?php
                foreach ($order as $item)
                {
                    ?>
                    <tr>
                        <td><?php echo $item["name"]; ?></td>
                        <td><?php echo $item["price"]; ?></td>
                        <td><?php echo $item["qtty"]; ?></td>
                    </tr>
                </table><?php
                }
            }
        }?>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>