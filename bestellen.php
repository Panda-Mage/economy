<?php
    session_start();
    
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

    </head>
    <body>
        <form>
            <label>Voornaam ouder/voogd</label>
            <input type="text">
            <label>Naam ouder/voogd</label>
            <input type="text">
            <label>Voornaam kind</label>
            <input type="text">
            <label>Naam kind</label>
            <input type="text">
            <input type="submit" value="E-PAY">
        </form>
    </body>
</html>