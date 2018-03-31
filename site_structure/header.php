<?php session_start() ?>
<header>
    <nav>
        <a href="#">Home</a>
        <a href="/pages/browse.php">Browse Products</a>
        <a href="/pages/login.php">
            <?php
            if (!isset($_SESSION["logged_on_user"]) || $_SESSION["logged_on_user"] == "")
                echo "Login";
            else
                echo "Logout";
            ?>
        </a>
    </nav>
</header>