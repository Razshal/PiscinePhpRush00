<?php include "../site_structure/head.php"; ?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <?php include "../site_structure/sidemenu.php"; ?>
        <div id="content">
        <h1>Sign in</h1>
        <form method="post" action="signed.php" name="signed.php">
            User: <input type="text" name="login"/>
            <br/>
            Password: <input type="password" name="passwd"/>
            <input type="submit" name="submit" value="OK"/>
        </form>
    </div>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>