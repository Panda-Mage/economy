<?php 

    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $groep = isset($_POST["klas"]) ? $_POST["klas"] : null;
        $foto = isset($_POST["foto"]) ? $_POST["foto"] : null;
        $fotoSource = "foto's/" . $groep . "/" . $foto;

        if ( $_SESSION["oauth_demo"]["ingelogd"] != true) {
        header("Location: login.php");
    }

?>

<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" href="foto's/custom_foto's/gosnapit.png">
        <title>AFBEELDING</title>
        <style>
            img {
                width: 60vw;
            }
        @media screen and (max-width: 1400px) {
            img {
                transform: rotate(90deg);
                width: 80vw;
                margin-top: 20vh;
            }
        }
        </style>
    </head>
    <body>

        <div class="main">

            <nav>
                <a href="photos.php?klas=<?php echo $groep; ?>"><p>TERUG NAAR FOTO'S</p></a>
            </nav>
            <div style="width: fit-content; margin: 2em auto;">
                <img src="<?php echo $fotoSource; ?>">
            </div>

            <div class="footer">
                <div class="verticalAlign">
                    <img src="foto's/custom_foto's//button_onder_toezicht_van_Vlajovzw_HR.jpg" >
                    <img src="foto's/custom_foto's/go-ao_logo.png">
                </div>
            </div>
            
        </div>

    </body>
</html>