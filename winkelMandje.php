<?php 
    session_start();

    if( $_SESSION["oauth_demo"]["ingelogd"] != true){
        header("Location: login.php");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["betalen"])){
            
            header("Location: oauth_demo.php?koop=true");
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
        <link rel="icon" href="foto's/custom_foto's/gosnapit.png">
        <title>WINKELMANDJE</title>
    </head>
    <body>

        <div class="main">

            <nav>
                <a href="index.php"><p>HOME</p></a>
                <a href="photos.php"><p>FOTO'S</p></a>
                <a href="winkelMandje.php"><img src="foto's/custom_foto's/winkelMandje.png"><p id="counter"><?php echo $counter ?></p></a> 
            </nav>

            <div class="container_content">

                <?php if($counter != 0): ?>
                    <div id="tableDiv">
                        <table>
                            <tr class="header">
                                <td><p>Item</p></td>
                                <td><p>Prijs</p></td> 
                            </tr>
                            <?php $prijs = 0; ?>
                            <?php foreach($_SESSION["items"] as $index =>$item): ?>
                                <tr >
                                    <td style="background-color: <?php if($index%2 == 0){ echo "darkgray";}else{ echo "gray";} ?>;"><p><?php echo ($item); ?></p></td>
                                    <td style="background-color: <?php if($index%2 == 0){ echo "darkgray";}else{ echo "gray";} ?>;"><p><?php if(strrpos($item,"PAKKET")){ echo "€5,50"; $prijs = $prijs+5.5; } else{echo "€3,50"; $prijs = $prijs+3.5;} ?></p></td>
                                    <form method="post"><td style="background-color: transparent; cursor:grab;"><button onclick="this.form.submit()" style="background-color: transparent; color:transparent; border:none;"><img class="trash" src="foto's/custom_foto's/trashBin.png"></button><input type="text" name="row" value="<?php echo $index  ?>" class="invisible"></td></form>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td style="background-color:red;"><p>TOTAAL</p></td>
                                <td style="background-color:darkred;"><p><?php if (strpos($prijs, '.') > 0) {echo '€'.$prijs."0";} else{ echo '€'.$prijs.".00";} $_SESSION["prijs"] = $prijs;?></p></td>
                            </tr>
                            <tr style="background-color: transparen;">
                                <td></td>
                                <form method="post"><td><input style="margin-top: 1em" type="submit" name="betalen" value="BESTELLEN"></td></form>
                            </tr>
                        </table>
                    </div>

                <?php else:?>

                    <h1 style="padding-top: 8vh;">SORRY</h1>
                    <h1>U WINKELMANDJE IS LEEG</h1>
                    <h1>:(</h1>

                <?php endif; ?>

            </div>

            <div class="footer">
                <div class="verticalAlign">
                    <img src="foto's/custom_foto's//button_onder_toezicht_van_Vlajovzw_HR.jpg" >
                    <img src="foto's/custom_foto's/go-ao_logo.png">
                </div>
            </div>

        </div>
        
    </body>
    <script>
    </script>
</html>