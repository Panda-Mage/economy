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

            <!-- <div class="container_complete_image"></div> -->

        </div>

    </body>
</html>