<?php 
    session_start();
    $counter = isset($_SESSION["items"])  ? count($_SESSION["items"]) : 0;
?>
<html>
    <head>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" href="foto's/custom_foto's/gosnapit.png">
        <title>HOME PAGE</title>
    </head>
    <body>
        <nav>
            <a href="index.php"><p>HOME</p></a>
            <a href="photos.php"><p>PHOTO'S</p></a>
            <a href="winkelMandje.php"><img src="foto's/custom_foto's/winkelMandje.png"><p id="counter"><?php echo $counter ?></p></a> 
        </nav>
        <h1>PHOTOGRAFIE</h1>
        <p>Wij zijn een studentenonderneming die met behulp van Vlajo en het go-atheneum onze verkoop van de klassen foto's kan waar maken.</p>
        <footer><img src="foto's/custom_foto's//button_onder_toezicht_van_Vlajovzw_HR.jpg" ></footer>
    </body>
</html>