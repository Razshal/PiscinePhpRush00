<header>
    <nav>
        <a href="/index.php">Home</a>
        <a href="/pages/browse.php">Buy</a>
        <?php
        if (!isset($_SESSION["logged_on_user"]) || $_SESSION["logged_on_user"] == ""){?>
        <a href="/pages/signin.php">Sign in</a><?php }
        else { ?>
        <a href="/pages/account.php">Account</a> <?php }?>
        <a href="/pages/login.php">
            <?php
            if (!isset($_SESSION["logged_on_user"]) || $_SESSION["logged_on_user"] == "")
                echo "Login";
            else
                echo "Logout";
            ?>
        </a>
        <a href="/pages/basket.php"></a>
    </nav>
</header>