<?php
    session_start();
    
    if( $_SESSION["oauth_demo"]["ingelogd"] != true;){
        header("Location: login.php");
    }

    include("account/account.php");
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo '<script>console.log("Connected successfully")</script>';
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        echo '<script>console.log("Connection failed: "' . $e->getMessage() . ')</script>';
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/bestellen.css">
        <link rel="icon" href="foto's/custom_foto's/gosnapit.png">
        <title>BESTELLEN</title>
    </head>
    <body>
        <nav>
            <a href="winkelMandje.php">
                <p><═ BACK</p>
            </a>
        </nav>
        <br>
        <form>
            <label>Voornaam ouder/voogd</label>
            <input type="text">
            <label>Achternaam ouder/voogd</label>
            <input type="text">
            <label>Voornaam kind</label>
            <input type="text">
            <label>Achternaam kind</label>
            <input type="text">
            <br>
            <input type="submit" value="E-PAY">
            <img src="foto's/custom_foto's/EPAYlogo.jfif">
        </form>
    </body>
</html>