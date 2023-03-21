<?php 

    if( $_SESSION["oauth_demo"]["ingelogd"] != true;){
        header("Location: login.php");
    }
    
?>
<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" href="foto's/custom_foto's/gosnapit.png">
        <title>AFBEELDING</title>
    </head>
    <body>

        <div include-html="navbar.html"></div>
        <img src="">
        
        <script src="js/includehtml.js"></script>
        <script>
            includeHTML();
        </script>
    </body>
</html>