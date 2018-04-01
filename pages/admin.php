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
    else if (isset($_POST["action_cat"]) && $_POST["action_cat"] != ""
        && isset($_POST["cat"]))
    {
        if ($_POST["action_cat"] === "delete")
            delete_category($_POST["cat"]);
        if ($_POST["action_cat"] === "add")
            create_category($_POST["cat"]);
    }
    else if (isset($_POST["action_prod"]) && $_POST["action_prod"] != "")
    {
        if ($_POST["action_prod"] === "delete")
            delete_product($_POST["prod"]);
        if ($_POST["action_prod"] === "add" && isset($_POST["name"]) && isset($_POST["image"])
            && isset($_POST["price"]) && isset($_POST["categories"]) && is_numeric($_POST["price"]))
        {
            echo " ok";
            $cat_array = explode(",", $_POST["categories"]);
            foreach ($cat_array as $cat)
            {
                if (!get_category($cat))
                    create_category($cat);
            }
            create_product($_POST["name"], $cat_array, $_POST["price"], $_POST["image"]);
        }
        else
            var_dump($_POST);

    }
    $users = get_users_database();
    $products = get_product_database();
    $categories = get_categories_database();
    ?>
    <html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <?php include "../site_structure/sidemenu.php"; ?>
        <div id="content">
        <h1>Users</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>IsAdmin</th>
                <th></th>
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
            }?>
        </table>
        <h1>Add user</h1>
        <form method="post" action="signed.php" name="signed.php">
            Identifiant: <input type="text" name="login"/>
            <br/>
            Mot de passe: <input type="password" name="passwd"/>
            <input type="submit" name="submit" value="OK"/>
        </form>
        <h1>categories</h1>
        <table>
            <tr>
                <th>Name</th>
            </tr>
            <?php foreach ($categories["categories"] as $item)
            {
                if (is_array($item)) {
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
                }
            } ?>
            <form method="post" action="admin.php" name="admin.php">
                <tr>
                    <td><input type="text" name="cat" value=""></td>
                    <td><input type="submit" name="action_cat" value="add"></td>
                </tr>
            </form>
        </table>

        <h1>Products</h1>
        <table>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Categories</th>
                <th>Price</th>
            </tr>
            <?php foreach ($products["products"] as $item)
            {
                ?>
                <tr>
                <td><img src="<?php echo $item["image"] ?>"/></td>
                <td><?php echo $item["name"] ?></td>
                <td><?php if (is_array($item["category"])) echo implode(",", $item["category"]); ?></td>
                <td><?php echo $item["price"] ?></td>
                <td>
                    <form method="post" action="admin.php" name="admin.php">
                        <input type="submit" name="action_prod" value="delete">
                        <input type="hidden" name="prod" value="<?php echo $item["name"] ?>">
                    </form>
                </td>
                </tr><?php
            } ?>
        </table>
        <br/>
        <form method="post" action="admin.php" name="admin.php">
        <table>
            <tr>
                <th>Name</th>
                <th>Categories comma separated</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
            <tr>
                <td><input type="text" name="name" value=""></td>
                <td><input type="text" name="categories" value=""></td>
                <td><input type="number" name="price" value=""></td>
                <td><input type="text" name="image" value=""></td>
                <td><input type="submit" name="action_prod" value="add"></td>
            </tr>
        </table>
        </form>


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