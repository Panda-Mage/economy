<?php 
    session_start();
    $counter = isset($_SESSION["items"])  ? count($_SESSION["items"]) : 0;

    if( $_SESSION["oauth_demo"]["ingelogd"] != true){
        header("Location: login.php");
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" href="foto's/custom_foto's/gosnapit.png">
        <title>Homepagina</title>
    </head>
    <body>
        
        <nav>
            <a href="index.php"><p>HOME</p></a>
            <a href="photos.php"><p>FOTO'S</p></a>
            <a href="winkelMandje.php"><img src="foto's/custom_foto's/winkelMandje.png"><p id="counter"><?php echo $counter ?></p></a> 
        </nav>
        
        <br>
        <br>
        <br>
        <div class="container_content">
            <div id="headtag">
                <h1>PHOTOGRAFIE</h1>
                <h2>GO SNAP IT</h2>
            </div>
            <div class="container_text alignCenter">
                <h1>OVER ONS:</h1>
                <p>Wij zijn een studenten onderneming bestaande uit 4 leerlingen van het 6e middelbaar.</p>
                <p>Via deze website kunt u de klasfoto(s) van uw zoon/dochter bestellen. Deze foto's zijn mede mogelijk gemaakt door het <a href="https://bezoek.go-atheneumoudenaarde.be/" target="_new">GO Atheneum Oudenaarde</a> en <a href="https://www.vlajo.org/" target="_new">Vlajo (Vlaamse Jonge Ondernemingen)</a></p>
            </div>
        </div>
        <footer><img src="foto's/custom_foto's//button_onder_toezicht_van_Vlajovzw_HR.jpg" ><img src="foto's/custom_foto's/go-ao_logo.png"></footer>
    </body>
</html>