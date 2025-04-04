<!DOCTYPE html>
<html>
    <?php 

        $mySQLClient = new PDO(
            'mysql:host=localhost;dbname=technowebprojetsimon;charset=utf8',
            'root','',
            [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION],
    
        );
    
    ?>

    <head>
        <meta charset="utf-8"/>
        <title>Jeu de Simon</title>
        <link rel="stylesheet" type="text/css" href="JeuSimonIntroPage.css"/>
        <meta name="viewport" content="width = device-width,initial-scale=10"/>
    </head>
    <body>
    <div id="TT">
        <h1>Jeu Simon</h1>
    <form class ="connection" method="POST" action="JeuSimonIntroPage.php">
        <input name="pseudo_login" class="registre" placeholder="pseudo"></input>
        <input name="mot_de_passe_login" type="password" class="password" id="password1" placeholder="mot de passe"></input>
        <button type="button" id="toggle-password" onclick="afficherpassword1()" >👁️</button>
        <button type="submit"class="registre" name="connection">connection</button>    
    </form>
    
    <form class ="new_connection" method="POST" action="JeuSimonIntroPage.php">
        <input name="pseudo_registre" class="registre" placeholder="pseudo"></input>
        <input name="mot_de_passe_registre" type="password" class="password" id="password2"  placeholder="mot de passe"></input>
        <button type="button" id="toggle-password" onclick="afficherpassword2()" >👁️</button>
        <button type="submit" class="registre" name="creation_de_compte">création de compte</button>
            
        </button>
    </form>
    </div>


    <?php 

    if ($_SERVER['REQUEST_METHOD']=== 'POST'){

    session_start();

    // Vérifier si les données du formulaire existent
    if (isset($_POST['connection'])) {
    if (($_POST["pseudo_login"]!=null) && ($_POST["mot_de_passe_login"]!=null)) {
        $pseudo_login=$_POST["pseudo_login"];
        $mot_de_passe_login=$_POST["mot_de_passe_login"];

        // Vérifier si le pseudo existe dans la base de données
        $requetes_connection_exist = "SELECT pseudo, mot_de_passe FROM joueur WHERE pseudo = :pseudo";
        $try_presence = $mySQLClient->prepare($requetes_connection_exist);
        $try_presence->execute(
            ['pseudo' => $pseudo_login]
        );

        if ($try_presence->rowCount() > 0) {
            // Récupérer l'utilisateur
            $user = $try_presence->fetch(PDO::FETCH_ASSOC);

            // Vérifier si le mot de passe est correct
            if (($mot_de_passe_login == $user['mot_de_passe'])) {
                // Mot de passe valide, démarrer la session
                $_SESSION['pseudo'] = $user['pseudo']; // Stocker le pseudo dans la session
                header("Location:JeuSimon.php");
                exit();
            } 
            else {
                // Mauvais mot de passe
                echo "Erreur : Mot de passe incorrect.";
            }
        } 
        else {
            // Pseudo non trouvé
            echo "Erreur : Ce nom d'utilisateur n'existe pas.";
        }
    } 
    else {
        echo "Erreur : Tous les champs doivent être remplis.";
    }   
    }
    if (isset($_POST['creation_de_compte'])) {
    if (($_POST["pseudo_registre"]!=null) && ($_POST["mot_de_passe_registre"]!=null)) {
        $pseudo_registre = trim($_POST["pseudo_registre"]);
        $mot_de_passe_registre = $_POST["mot_de_passe_registre"];
        
        // Vérifier si l'utilisateur existe déjà (REQUÊTE PRÉPARÉE)
        $requete_pseudo = "SELECT pseudo FROM joueur WHERE pseudo = :pseudo";
        $try_pseudo = $mySQLClient->prepare($requete_pseudo);
        $try_pseudo->execute(
            ['pseudo' => $pseudo_registre]
        );
        if ($try_pseudo->rowCount() > 0) {
            die("Erreur : Ce nom d'utilisateur est déjà pris.");
        } 
        else {
            // Hasher le mot de passe
        
            // Insérer l'utilisateur dans la base de données (REQUÊTE PRÉPARÉE)
            $requete_mot_de_passe = "INSERT INTO joueur (pseudo, meilleur_score, mot_de_passe,lvl1,lvl2,lvl3) VALUES (:pseudo, 0, :mot_de_passe,0,0,0)";
            $requete_creation = $mySQLClient->prepare($requete_mot_de_passe);
            $requete_creation->execute(
                ['pseudo' => $pseudo_registre,
                'mot_de_passe' => $mot_de_passe_registre]
            );
    
            echo "Inscription réussie !";
        }
    } 
    else {
        echo "Erreur : Tous les champs doivent être remplis.";
    }
    }
}





        //Prepare une requête pour avoir tous les username

        //Pour la lecture dans SQL
        //$user = $users_sql -> fetchAll();
        //echo($user);
    ?>
    </body>
    <script src="JeuSimonjs.js"></script>
</html>