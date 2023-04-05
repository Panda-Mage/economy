<?php

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

            html {
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
                position: fixed;
                z-index: -1;

                background-position: 0em -18em;
                background-repeat: no-repeat;
                background-size: 120em;

                filter: blur(8px);
            }

            .container_complete_text {
                width: fit-content;
                margin: 5em auto 0em auto;
                padding: 2em;
                text-align: center;
                background: rgba(0, 0, 0, 0.8);
                border: 1.8em ridge rgb(128, 64, 0);
            }

            .container_complete_text_normal {
                margin-top: 2em;
            }

            .headerText {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                font-size: 25pt;
                color: rgb(197, 7, 81);
            }

            .text {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                font-size: 20pt;
                color: white;
            }

            .Completed_return_link {
                color: rgb(197, 7, 81);
                text-decoration: none;
            }

        </style>
    </head>
    <body>

        <div>
            <?php if( stripos($_SESSION["oauth_demo"]["message"], "200") > 0): ?>
                <div class="container_complete_image"></div>
                <div class="container_complete">
                    <div class="container_complete_text">
                        <h1 class="headerText">Bedankt voor je bestelling!</h1>
                        <div class="container_complete_text_normal">
                            <p class="text">Uw foto's zijn succesvol besteld.</p>
                            <p class="text">Van zodra deze klaar zijn, zullen alle bestelde klasfoto's worden afgegeven aan uw zoon/dochter.</p>
                            <p class="text" style="font-size: 22pt;"> <span style="color: rgb(197, 7, 81); font-size: 30pt;">&#8592;</span> <a class="Completed_return_link" href="index.php">Terug naar homepagina</a></p>
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
                <h1>Er staat niet genoed saldo op uw epay voor deze aankoop.</h1>
                <h1>Gelieve uw saldo aan te vullen en dan nogmaals opnieuw te proberen!</h1>
            <?php else: ?>
                <h1>Er liep iets mis. Probeer het later opnieuw!</h1>
                <?php var_dump($_SESSION["oauth_demo"]["message"]); ?>
            <?php endif; ?>
        </div>

    </body>
</html>