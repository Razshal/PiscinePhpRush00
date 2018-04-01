<?php
include "../site_structure/head.php";
include "../functions/get_json.php";
include "../functions/set_json.php";

if ($_SESSION["admin"] === 1)
{
    if (isset($_POST["action_user"]) && $_POST["action_user"] != ""
        && isset($_POST["user"]) && get_user($_POST['user']))
    {
        if ($_POST["action_user"] === "delete")
        {
            delete_user($_POST["user"]);
            delete_all_user_orders($_POST["user"]);
        }
        if ($_POST["action_user"] === "make_admin")
            make_admin_or_not($_POST["user"], 1);
        if ($_POST["action_user"] === "unmake_admin")
            make_admin_or_not($_POST["user"], 0);
    }
    if (isset($_POST["action_cat"]) && $_POST["action_cat"] != ""
        && isset($_POST["cat"]) && get_user($_POST['cat']))
    {
        if ($_POST["action_cat"] === "delete")
        {
            delete_ca
        }
    }
    $users = get_users_database();
    $products = get_product_database();
    $categories = get_categories_database();
    ?>

    <html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <h1>Users</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>IsAdmin</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users["users"] as $user)
            {
                ?>
                <tr>
                <td><?php echo $user["login"] ?></td>
                <td><?php echo $user["isadmin"] ?></td>
                <td>
                    <form method="post" action="admin.php" name="admin.php">
                        <input type="submit" name="action_user" value="delete">
                        <input type="submit" name="action_user" value="make_admin">
                        <input type="submit" name="action_user" value="unmake_admin">
                        <input type="hidden" name="user" value="<?php echo $user["login"] ?>">
                    </form>
                </td>

                </tr><?php
            } ?>
        </table>
        <h1>categories</h1>
        <table>
            <tr>
                <th>Name</th>
            </tr>
            <?php foreach ($categories["categories"] as $item)
            {
                ?>
                <tr>
                <td><?php echo $item["name"] ?></td>
                <td>
                    <form method="post" action="admin.php" name="admin.php">
                        <input type="submit" name="action_cat" value="delete">
                        <input type="hidden" name="cat" value="<?php echo $item["name"] ?>">
                    </form>
                </td>

                </tr><?php
            } ?>
        </table>


        <?php include "../site_structure/footer.php"; ?>
    </body>
    </html>
    <?php
}
else
{?>
        <?php include "../site_structure/head.php"; ?>
    <html>
        <body>
            <?php include "../site_structure/header.php"; ?>
            <h1>403 Not allowed</h1>
            <?php include "../site_structure/footer.php"; ?>
        </body>
    </html>
    <?php
}?>