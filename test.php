<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>ATCiss for IVAO DE - by Luk_H</title>
</head>
<body>
<?php
date_default_timezone_set("UTC");
// Authentifizierungstoken aus Datei lesen
$auth = trim(fread(fopen('auth.bin', 'r'), filesize('auth.bin')));

// Optionen für den HTTP-Kontext
$options = ["http" => ["header" => "Authorization: Bearer " . $auth]];
$context = stream_context_create($options);

// API-Anfrage
$content = file_get_contents("https://avwx.rest/api/metar/eddl?airport=true", false, $context);

if ($content === FALSE) {
    echo "Hmm, es ist ein Fehler aufgetreten! Bitte kontakiere Luk_h auf Discord";
    $error = true;
}
else {
    $results = json_decode($content);
        $error = false;
}
?>
<header>
    <div class="titlebar">
        <div id="icao">
            <?php
                if (!$error) {echo "<h2>" . $results->station . "</h2>";}
            ?>
        </div>
        <div id="time">
            <?php
                if (!$error) {echo "<h3>" . date("H:i"). "z" . "</h3>";}
            ?>
        </div>
    </div>

    <div class="devide">
    </div>
</header>
<main>
    <div id="state">
        <?php
        //TODO:IMC/VMC
        ?>
    </div>
    <div id="wind">
        <?php
        //TODO:wind
        ?>
    </div>
    <div id="clouds">
        <?php
        //TODO:clouds
        ?>
    </div>
    <div id="QNH">
        <?php
        //TODO:QNH
        ?>
    </div>
    <div id="temp">
        <?php
        //TODO:temp
        ?>
    </div>
</main>
</body>
</html>
