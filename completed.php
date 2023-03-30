<?php 
   ini_set('display_errors', '1');
   ini_set('display_startup_errors', '1');
   error_reporting(E_ALL);

    session_start();

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
?>

<html>
    <head>
        <title>Bedankt!</title>
        <style>

            body, html {
                height: 90%;
                margin: 0px;
                background: rgb(192, 192, 192);
            }

            .container_complete_image {
                background-image: url("foto's/custom_foto's/bedrijfslogo.png");
                height: 100%;

                top: 0;
                left: 0;
                right: 0;
                position: absolute;

                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;

                filter: blur(8px);
                z-index: 0;
            }

            .container_complete_text {
                margin: 5em auto 0em auto;
                text-align: center;
                z-index: 1;
            }

            .container_complete_text_normal {
                margin-top: 2em;
            }

            .headerText {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                font-size: 25pt;
            }

            .text {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                font-size: 20pt;
            }
        </style>
    </head>
    <body>

        <div>
            <?php if( stripos($_SESSION["oauth_demo"]["message"], "200") > 0): ?>
                <div class="container_complete">
                    <div class="container_complete_text">
                        <h1 class="headerText">Bedankt voor je bestelling!</h1>
                        <div class="container_complete_text_normal">
                            <p class="text">uw foto's zijn succesvol besteld, en komen zo snel mogelijk uw kant op.</p>
                            <p class="text">van zodra deze klaar zijn zullen alle bestelde foto's worden afgeleverd aan uw kind.</p>
                            <p class="text" style="font-size: 22pt;">klik <a href="index.php">hier</a> om terug te keren naar de homepagina</p>
                        </div>
                    </div>
                </div>
                <?php 
                    
                    $aankoop = implode(", ",$_SESSION["items"]);

                    $stmtAankoop = $conn->prepare("INSERT INTO Aankopen (Voornaam, Achternaam, Klas, Items, Prijs) 
                                                   VALUES('".$_SESSION["oauth_demo"]["voornaam"]."','".$_SESSION["oauth_demo"]["naam"]."','".$_SESSION["oauth_demo"]["klas"]."','".$aankoop."',".$_SESSION["prijs"].")
                                                ");
                    $stmtAankoop->execute();
                    
                    $_SESSION["prijs"] = null;
                    $_SESSION["items"] = null;
                ?>
                
            <?php elseif(strpos($_SESSION["oauth_demo"]["message"], "Saldo ontoereikend") > 0): ?>
                <h1>Er staat niet genoed geld op u epay voor deze aankoop.</h1>
                <h1>Gelieve u saldo aan te vullen en dan nogmaals opniew te proberen!</h1>
            <?php else: ?>
                <h1>Dit is een zeldzame ERROR</h1>
                <h1>Contacteer Roel Verleyen via smartschool</h1>
                <?php var_dump($_SESSION["oauth_demo"]["message"]); ?>
            <?php endif; ?>
        </div>

    </body>
</html>