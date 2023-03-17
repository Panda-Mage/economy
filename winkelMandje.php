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

    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["betalen"])){

        }
        else{
            unset($_SESSION["items"][$_POST["row"]]);
        }
    }

    $counter = isset($_SESSION["items"])  ? count($_SESSION["items"]) : 0;
?>
<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/winkelMandje.css">
    </head>
    <body>
        <nav>
            <a href="index.php"><p>HOME</p></a>
            <a href="photos.php"><p>PHOTO'S</p></a>
            <a href="winkelMandje.php"><img src="foto's/custom_foto's/winkelMandje.png"><p id="counter"><?php echo $counter ?></p></a> 
        </nav>
        <div id="tableDiv">
            <table>
                <tr class="header">
                    <td><p>Item</p></td>
                    <td><p>Prijs</p></td> 
                </tr>
                <?php $prijs = 0; ?>
                <?php foreach($_SESSION["items"] as $index =>$item): ?>
                    <tr >
                        <td style="background-color: <?php if($index/2 == 0){ echo "darkgray";}else{ echo "gray";} ?>;"><p><?php echo ($item); ?></p></td>
                        <td style="background-color: <?php if($index/2 == 0){ echo "darkgray";}else{ echo "gray";} ?>;"><p><?php if(strrpos($item,"PAKKET")){ echo "€5,50"; $prijs = $prijs+5.5; } else{echo "€3,50"; $prijs = $prijs+3.5;} ?></p></td>
                        <form method="post"><td style="background-color: transparent; cursor:grab;"><button onclick="this.form.submit()" style="background-color: transparent; color:transparent; border:none;"><img class="trash" src="foto's/custom_foto's/trashBin.png"></button><input type="text" name="row" value="<?php echo $index  ?>" class="invisible"></td></form>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td style="background-color:red;"><p>TOTAAL</p></td>
                    <td style="background-color:darkred;"><p><?php echo '€'.$prijs; ?></p></td>
                </tr>
                <tr style="background-color: transparen;">
                    <td></td>
                    <form method="post"><td><input type="submit" name="betalen" value="BETALEN"></td></form>
                </tr>
            </table>
        </div>
        <footer><img src="foto's/custom_foto's//button_onder_toezicht_van_Vlajovzw_HR.jpg" ></footer>
    </body>
    <script>
    </script>
</html>