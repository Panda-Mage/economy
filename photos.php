<?php
    session_start();
    $counter = isset($_SESSION["items"])  ? count($_SESSION["items"]) : 0;
    $_SESSION["items"] = isset($_SESSION["items"])  ? $_SESSION["items"] : [];
    $groep = isset($_GET["Klas"]) ? $_GET["Klas"] : "null";

    if( $_SESSION["oauth_demo"]["ingelogd"] != true){
        header("Location: login.php");
    }

    include("account/account.php");
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4;", $username, $password);
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

    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["NORMAAL"])){
            $_SESSION["items"][count($_SESSION["items"])] = $_POST["klas"]."_".$_POST["NORMAAL"];
        }
        elseif(isset($_POST["GEK"])){
            $_SESSION["items"][count($_SESSION["items"])] = $_POST["klas"]."_".$_POST["GEK"];
        }
        else{
            $_SESSION["items"][count($_SESSION["items"])] = $_POST["klas"]."_".$_POST["PAKKET"];
        }
        $counter++;
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/photos.css">
        <link rel="icon" href="foto's/custom_foto's/gosnapit.png">
        <title>FOTO'S</title>
    </head>
    <body>
        <div class="main">

            <nav>
                <a href="index.php"><p>HOME</p></a>
                <a href="photos.php"><p>FOTO'S</p></a>
                <a href="winkelMandje.php"><img src="foto's/custom_foto's/winkelMandje.png"><p id="counter"><?php echo $counter ?></p></a> 
            </nav>

            <div class="container_content">
                <div id="kiesKlasDiv">
                    <form>
                        <label class="mobilePlayer">KLASSEN:</label>
                        <select class="mobilePlayer" id="klas" name="Klas" onchange="this.form.submit(klasgekozen)">
                            <option value="null">SELECT</option>
                            <?php foreach($klassen as $klas): ?>
                                <option value="<?php echo $klas["klasnaam"]; ?>" <?php if($klas["klasnaam"] == $groep){echo "selected";} ?>><?php echo $klas["klasnaam"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                
                <?php if($groep != "null"): ?>
                    <div id="photoDiv">
                        <form action="afbeelding.php" method="POST">
                            <input style="display: none;" type="text" name="klas" value="<?php echo $groep; ?>">
                            <input style="display: none;" type="text" name="foto" value="/Normaal.jpg">
                            <img onclick="submitForm(event)" src="foto's/<?php echo $groep; ?>/Normaal.jpg" id="links" onError='ErrorNormaal(this)'>
                        </form>
                        <form action="afbeelding.php" method="POST">
                            <input style="display: none;" type="text" name="klas" value="<?php echo $groep; ?>">
                            <input style="display: none;" type="text" name="foto" value="/Gek.jpg">
                            <img onclick="submitForm(event)" src="foto's/<?php echo $groep; ?>/Gek.jpg" id="rechts" onError='ErrorGek(this)'>
                        </form>
                    </div>
                    <div id="koopDiv">
                        <form method="post">
                            <div style="text-align: center; width: 100%;">
                                <div id="normaal">
                                    <p>€3,50</p>
                                    <input name = "NORMAAL" type="submit" value="NORMAAL">
                                </div>
                                <div id="gek">
                                    <p id="rechterPrijs">€3,50</p>
                                    <input name = "GEK" type="submit" value="GEK" id="gekkeKnop">
                                </div>
                                <br>
                                <div id="pakket">
                                    <p id="middelPrijs">€5,50</p>
                                    <input name="PAKKET" type="submit" value="PAKKET" id="middelsteKnop">
                                </div>
                                <input type="text" class="invisible" name="klas" value="<?php echo $groep ?>">
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <div class="footer">
                <div class="verticalAlign">
                    <img src="foto's/custom_foto's//button_onder_toezicht_van_Vlajovzw_HR.jpg" >
                    <img src="foto's/custom_foto's/go-ao_logo.png">
                </div>
            </div>

        </div>
        
        <script>

            var klas = document.getElementById('klas');
            var linkerFoto = document.getElementById('links');
            var rechterFoto = document.getElementById('rechts');
            var rechterKoopKnop = document.getElementById('gekkeKnop');
            var middelKoopKnop = document.getElementById('middelsteKnop');
            var rechterPrijs = document.getElementById('rechterPrijs');
            var middelPrijs = document.getElementById('middelPrijs');

            var errors = [];

            function klasgekozen(){
                window.location.href = "photos.php?"+klas.value;
            }

            function ErrorNormaal(origine){
                origine.src = "foto's/custom_foto's/errorNormaal.jpg";

            }

            function ErrorGek(origine){
                origine.src = "foto's/custom_foto's/errorGek.jpg";
                rechterKoopKnop.style.display = "none";
                middelKoopKnop.style.display = "none";
                rechterPrijs.style.display = "none";
                middelPrijs.style.display = "none";
            }

            function submitForm(event) {
                console.log(event.target.parentElement);
                let form = event.target.parentElement;
                form.submit();
            }
            
        </script>
    </body>
</html>