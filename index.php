<?php 
    session_start();
    $counter = isset($_SESSION["items"])  ? count($_SESSION["items"]) : 0;
?>
<html>
    <head>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <nav>
            <a href="index.php"><p>HOME</p></a>
            <a href="photos.php"><p>PHOTO'S</p></a>
            <a href="winkelMandje.php"><img src="foto's/custom_foto's/winkelMandje.png"><p id="counter"><?php echo $counter ?></p></a> 
        </nav>
        <h1></h1>
        <footer><img src="foto's/custom_foto's//button_onder_toezicht_van_Vlajovzw_HR.jpg" ></footer>
    </body>
</html>