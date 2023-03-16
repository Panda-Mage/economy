<?php 
    session_start();
    $counter = isset($_SESSION["items"])  ? count($_SESSION["items"]) : 0;
    $groep = isset($_GET["Klas"]) ? $_GET["Klas"] : "null";

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
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/photos.css">
    </head>
    <body>
        <nav>
            <a href="index.php"><p>HOME</p></a>
            <a href="photos.php"><p>PHOTO'S</p></a>
            <a href="winkelMandje.php"><img src="foto's/custom_foto's/winkelMandje.png"><p id="counter"><?php echo $counter ?></p></a> 
        </nav>
        <div id="kiesKlasDiv">
            <form methode="post">
                <label>KLASSEN:</label>
                <select id="klas" name="Klas" onchange="this.form.submit(klasgekozen)">
                    <option value="null">SELECT</option>
                    <?php foreach($klassen as $klas): ?>
                        <option value="<?php echo $klas["klasnaam"]; ?>" <?php if($klas["klasnaam"] == $groep){echo "selected";} ?>><?php echo $klas["klasnaam"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
        <?php if($groep != "null"): ?>
            <div id="photoDiv">
                <img src="foto's/<?php echo $groep; ?>/Normaal.jpg" id="links" onError='ErrorNormaal(this)'>
                <img src="foto's/<?php echo $groep; ?>/Gek.jpg" id="rechts" onError='ErrorNormaal(this)'>
            </div>
            <div id="koopDiv">
                
            </div>
        <?php else: ?>

        <?php endif; ?>
        
        <script>
            var klas = document.getElementById('klas');
            var linkerFoto = document.getElementById('links');
            var rechterFoto = document.getElementById('rechts');

            var errors = [];

            function klasgekozen(){
                window.location.href = "photos.php?"+klas.value;
            }

            function ErrorNormaal(origine){
                origine.src = "foto's/custom_foto's/errorNormaal";

            }

            function ErrorGek(origine){
                origine.src = "foto's/custom_foto's/errorGek";
            }
            
        </script>
    </body>
</html>