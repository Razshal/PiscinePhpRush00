<?php include "site_structure/head.php" ?>
<html>
<body>
    <?php include "site_structure/header.php" ?>
    <?php include('site_structure/sidemenu.php'); ?>
    <div id="content">
      <h2>Welcome to GAMESHOP! Here you can buy every game you want!</h2>
    </div>
    <div id="contentindex">
    	<?php
        function get_product_database_index()
       {
        if (file_exists("database/products.json"))
            return json_decode(file_get_contents("database/products.json"), true);
            else
            {
                $list = array();
                $list["products"] = array();
                return $list;
            }
        }
    $array = get_product_database_index();
    foreach ($array["products"] as $cat)
    {
    	?>
    	<figure>
           <p><div class="thumbnail"><img src="<?php echo($cat["image"]); ?>" alt="<?php echo($cat["name"]); ?>"></div>

               <figcaption><p><?php echo($cat["name"]); ?></p><p><?php echo($cat["price"]); ?>&euro;</p></figcaption>
           </figure>
           <?php 
       } 
       ?>
   </div>
   <?php include "site_structure/footer.php"; ?>
</body>
</html>