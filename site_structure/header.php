<!--<header>
    <nav>
        <a href="/index.php">Home</a>
        <a href="/pages/buy.php">Buy</a>
        <?php
        if (!isset($_SESSION["logged_on_user"]) || $_SESSION["logged_on_user"] == ""){?>
        <a href="/pages/signin.php">Sign in</a><?php }
        else {?>
        <a href="/pages/account.php">Account</a> <?php }?>
        <a href="/pages/login.php"><?php
            if (!isset($_SESSION["logged_on_user"]) || $_SESSION["logged_on_user"] == "")
                echo "Login";
            else
                echo "Logout";?></a>
        <a href="/pages/basket.php">Basket (<?php
            if (isset($_SESSION["basket"]))
                echo count($_SESSION["basket"]);
            else
                echo 0;?>)</a>
        <?php
        if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1)
            echo "<a href=\"/pages/admin.php\">Admin</a>";?>
    </nav>
</header>-->
<section class="logo">
    <a href="/index.php"><h3>GAMESHOP</h3></a>
</section>
<div id='cssmenu'>
    <ul>
        <li class='standard'><a href='/index.php'>Accueil</a></li>
        </li>
        <?php
            if (!isset($_SESSION["logged_on_user"]) || $_SESSION["logged_on_user"] == ""){?>
        <li class="standard"><a href="/pages/signin.php">Sign in</a></li>
        <?php }
            else { ?>
        <li class="standard"><a href="/pages/account.php">Account</a></li>
        <?php }?>
        <li class="standard"><a href="/pages/login.php">
            <?php
                if (!isset($_SESSION["logged_on_user"]) || $_SESSION["logged_on_user"] == "")
                            echo "Login";
                else
                        echo "Logout";
                ?>
            </a>
        </li>
        <li class="standard"><a href="/pages/basket.php">Basket (<?php
            if (isset($_SESSION["basket"]))
                echo count($_SESSION["basket"]);
            else
                echo 0;?>)</a>
        </li>
        <li><a href="/pages/buy.php">Buy</a></li>
        <li class="standard"><?php
        if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1)
            echo "<a href=\"/pages/admin.php\">Admin</a>";?></li>
    </ul>
</div>
