<?php
include "../site_structure/head.php";
include "../functions/get_json.php";
include "../functions/set_json.php";

$users = get_users_database();
$products = get_product_database();
$categories = get_categories_database();

?>

<html>
    <body>
        <?php include "../site_structure/header.php"; ?>

        <h1>Users</h1>
        <form method="post" action="admin.php" name="admin.php">
            <table>
                <tr>
                    <th>Name</th>
                    <th>IsAdmin</th>
                </tr>
                <?php foreach ($users["users"] as $user)
                {
                    ?>
                <tr>
                    <td><?php echo $user["login"]?></td>
                    <td><?php echo $user["isadmin"]?></td>
                </tr><?php
                }?>


            </table>
        </form>

        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>