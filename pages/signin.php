<?php include "../site_structure/head.php"; ?>
<html>
    <body>
        <?php include "../site_structure/header.php"; ?>
        <h1>Sign in</h1>
        <form method="post" action="signed.php" name="signed.php">
            Identifiant: <input type="text" name="login"/>
            <br/>
            Mot de passe: <input type="password" name="passwd"/>
            <input type="submit" name="submit" value="OK"/>
        </form>
        <?php include "../site_structure/footer.php"; ?>
    </body>
</html>