<?php
include "../site_structure/head.php"; ?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <h1>Login</h1>
        <form method="post" action="logged.php" name="logged.php">
            Identifiant: <input type="text" name="login"/>
            <br/>
            Mot de passe: <input type="password" name="passwd"/>
            <input type="submit" name="submit" value="OK"/>
        </form>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>
