<?php 
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

    $stmtKlassen = $conn->prepare("SELECT K.klasnaam
                                FROM klassen K
                                ORDER BY K.Klasnaam
                                ");
    $stmtKlassen->execute();
    $klassen = [];
    while ($result=$stmtKlassen->fetch()){
        $klassen[] = $result;
    }
?>
<html>
    <head>

    </head>
    <body>
        <form>
            <select name="Klass">
                <?php foreach($klassen as $klas): ?>
                    <option><?php echo $klas["klasnaam"] ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </body>
</html>