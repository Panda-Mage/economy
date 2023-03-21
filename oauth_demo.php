<?php
session_start();
if (!isset($_SESSION["oauth_demo"])) {
    $_SESSION["oauth_demo"] = array("ingelogd"=>false);
}

$oAuthAppName = "photografie";
$oAuthLoginUrl = "https://www.go-atheneumoudenaarde.be/dashboard_dev/oAuthLogin.php";
$oAuthGetUserInfoUrl = "https://www.go-atheneumoudenaarde.be/dashboard_dev/oAuthGetUserInfo.php";

$epayAppName = "photografie";
$epayPassword = "demo";
$epayLoginUrl = "https://www.go-atheneumoudenaarde.be/epay_dev/public/api/login_check";
$epayPayUrl = "https://www.go-atheneumoudenaarde.be/epay_dev/public/api/pay";

// De gebruiker wil inloggen
if (isset($_GET["login"])) {
    // redirect naar login pagina, dit kan enkel als je een geldige appName hebt
    header("Location: ".$oAuthLoginUrl. "?app=" .$oAuthAppName);
}
// De gebruiker wil uitloggen
if (isset($_GET["logout"])) {
    // redirect naar login pagina, dit kan enkel als je een geldige appName hebt
    $_SESSION["oauth_demo"] = array("ingelogd"=>false);
    header("Location: oauth_demo.php");
}

// de gebruiker is op smartschool ingelogd, we vragen de gegevens van de gebruiker op
if (isset($_GET["code"])) {
    $userToken = $_GET["code"];
    $dataJson = json_encode(array("app" => $oAuthAppName, "code" => $userToken));
    $options = array(
        'Content-Type: application/json',
        'Content-Length: '. strlen($dataJson)
    );
    $ch = curl_init($oAuthGetUserInfoUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $options);

    $result = curl_exec($ch);
    $result = json_decode($result, true);

    // gebruiker is ingelogd, we slaan alle info op in een sessie
    $_SESSION["oauth_demo"]["ingelogd"] = true;
    $_SESSION["oauth_demo"]["voornaam"] = $result["voornaam"];
    $_SESSION["oauth_demo"]["naam"] = $result["naam"];
    $_SESSION["oauth_demo"]["klas"] = $result["klas"];
    $_SESSION["oauth_demo"]["userToken"] = $userToken;
    header("Location: oauth_demo.php");
}

// de ingelogde gebruiker wil iets kopen
if ($_SESSION["oauth_demo"]["ingelogd"] && isset($_GET["koop"])) {
    // we vragen eerst een token aan bij epay
    $data = array("username" => $epayAppName, "password" => $epayPassword);
    $data_string = json_encode($data);

    $ch = curl_init($epayLoginUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        )
    );

    $result = curl_exec($ch);
    $result = json_decode($result, true);
    $appToken = $result["token"];
    var_dump($appToken);
    // met deze appToken kunnen we een betaling uitvoeren voor de userToken
    $options = array(
        'Authorization: Bearer ' . $appToken,
        'Content-Type: application/json'
    );
    $userToken = $_SESSION["oauth_demo"]["userToken"];
    $bedrag = $_SESSION["prijs"];
    $description = "klasse foto's"; // dit zal de leerling zien in de epay transactie
    $message = "u aankoop bedraagt: \r\n"; // dit komt in het email bericht
    foreach($_SESSION["items"] as $item){
        $message += $item."\r\n"; 
    }
    $dataJson = json_encode(array(
        "appName" => $epayAppName,
        "userToken" => $userToken,
        "amount" => $bedrag,
        "description" => $description,
        "message" => $message
    ));
    $ch = curl_init($epayPayUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $options);

    $result = curl_exec($ch);
    var_dump($result);
    var_dump($_SESSION["prijs"]);
    die();
    $_SESSION["oauth_demo"]["message"] = $result;
    header("Location: oauth_demo.php");
}


$gebruikerIsIngelogd = $_SESSION["oauth_demo"]["ingelogd"];
if ($gebruikerIsIngelogd) {
    $naam = $_SESSION["oauth_demo"]["naam"];
    $voornaam = $_SESSION["oauth_demo"]["voornaam"];
    $klas = $_SESSION["oauth_demo"]["klas"];
    $message = isset($_SESSION["oauth_demo"]["message"]) ? $_SESSION["oauth_demo"]["message"] : "";
    unset($_SESSION["oauth_demo"]["message"]);
}
?>
<html>
<head>
    <title>Demo</title>
</head>
<body>
    <?php if ($gebruikerIsIngelogd) : ?>
        <p>welkom <?php echo $voornaam; ?> <?php echo $naam; ?> uit de klas <?php echo $klas; ?>(<a href="oauth_demo.php
?logout=1">logout</a>)</p>
        <?php if ($message != ""): ?>
            <p style="color:red"><?php echo $message; ?></p>
        <?php endif; ?>
    <?php else: ?>
        <p>Je bent niet ingelogd</p>
        <p><a href="oauth_demo.php?login=1">Login</a></p>
    <?php endif; ?>
</body>
</html>
