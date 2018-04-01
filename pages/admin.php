<?php
include "../site_structure/head.php";
include "../functions/get_json.php";
include "../functions/set_json.php";

$users = get_users_database();
$products = get_product_database();
$categories = get_categories_database();

if (isset($_POST["action_user"]) && $_POST["action_user"] != "")
{
    if ($_POST["action_user"] === "delete")
    {

    }
}

?>

<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <?php include_once "../site_structure/sidemenu.php"; ?>
        <div id="sidePanel">
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
                    <td><?php echo $user["login"]?></td>
                    <td><?php echo $user["isadmin"]?></td>
                    <td>
                        <form method="get" action="admin.php" name ="admin.php">
                            <input type="submit" name="action_user" value="delete">
                            <input type="hidden" name="user" value="<?php echo $user["login"]?>">
                        </form>
                    </td>

                </tr><?php
                }?>
            </table>
        </div>
        <div id="content">
        <h1>Add User</h1>
        <form method="post" action="signed.php" name="signed.php">
            Identifiant: <input type="text" name="login"/>
            <br/>
            Mot de passe: <input type="password" name="passwd"/>
            <input type="submit" name="submit" value="OK"/>
        </form>
    </div>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>