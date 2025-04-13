<!DOCTYPE html>
<html>
<?php 

$mySQLClient = new PDO(
    'mysql:host=localhost;dbname=technowebprojetsimon;charset=utf8',
    'root','',
    [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION],

);

session_start(); // Démarrer la session pour récupérer les variables

if (!isset($_SESSION['pseudo'])) {
    header("Location: JeuSimonIntroPage.php"); // Rediriger si l'utilisateur n'est pas connecté
    exit();
}

echo "Bienvenue, " . htmlspecialchars($_SESSION['pseudo']) . " !";
?>
<head>
    <meta charset="utf-8" />
    <title>Jeu de Simon</title>
    <link rel="stylesheet" type="text/css" href="JeuSimonstyle.css" />
    <meta name="viewport" content="width = device-width,initial-scale=10" />
</head>

<body>
    <div class="TT">
    <h1>Jeu de Simon</h1>
    <div id="choix">
        <input type="radio" Name="choix" value="1" id="c1" onclick=azer() > difficulté 1
        <input type="radio" Name="choix" value="2" id="c2" onclick=azer() > difficulté 2
        <input type="radio" Name="choix" value="3" id="c3" onclick=azer()> difficulté 3
    </div>
    <section class="couleurs">
        <div class="items" type="button" id="red" onclick=Rouge(secret) disabled=false ></div>
        <div class="items" type="button" id="bleu" onclick=Bleu(secret)></div>
        <div class="items" type="button" id="jaune" onclick=Jaune(secret)></div>
        <div class="items" type="button" id="vert" onclick=Vert(secret)></div>
    </section>
    <button id="start" type="submit" onclick=choix_séquence()>press to play</button>
    </div>

    <form  method="POST" action="JeuSimon.php">
    <button type="submit" name="deconnexion">Se déconnecter</button>
    </form>

    <p id="chrono">0:0:0</p>


    <audio id="background-music" >
        Votre navigateur ne supporte pas l'audio.
    </audio>
    <button class="music-button" onclick="toggleMusic()">🎵 Activer la musique</button>

    <label for="volume-control1">Volume bruitage:</label>
    <input type="range" id="volume-control1" min="0" max="1" step="0.1" value="0.5">




    <label for="volume-control2">Volume musique:</label>
    <input type="range" id="volume-control2" min="0" max="1" step="0.1" value="0.5">
    
    <?php 
    
    
    /*
    $SQLQuery = ""
    $SQLQuery
    $users_sql=$mySQLClient->prepare($SQLQuery)
    $users_sql->execute([
        'email'=>$email
    ])
    //Pour la lecture dans SQL
    $user = $users_sql -> fetchAll();
    */

    if (isset($_POST['deconnexion'])) {
        session_destroy(); // Détruit toutes les variables de session
        header("Location: JeuSimonIntroPage.php"); // Redirige vers la connexion
        exit();
    }
    ?>
</body>
<script src="JeuSimonjs.js"></script>

</html>