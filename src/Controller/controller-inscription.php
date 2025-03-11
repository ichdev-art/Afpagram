<?php


require_once '../../config.php';

$regex_name = "/^[a-zA-Zï]+$/";
$regex_password = "/^[a-zA-Z0-9]{8,30}+$/";
$regex_pseudo = "/^[A-Za-z0-9-_-]+$/";
$regex_date = "/^[0-9--]{10}+$/";
$error = [];



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nom'])) {
        if (empty($_POST['nom'])) {
            $error['nom'] = 'Nom obligatoire';
        } elseif (!preg_match($regex_name, $_POST['nom'])) {
            $error['nom'] = 'Caractère non autorisés';
        }
    }
    if (isset($_POST['prenom'])) {
        if (empty($_POST['prenom'])) {
            $error['prenom'] = 'Prénom obligatoire';
        } else if (!preg_match($regex_name, $_POST['prenom'])) {
            $error['prenom'] = 'Caractère non autorisés';
        }
    }

    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // on stock notre requete avec les marqueurs
    $sql = 'SELECT * from `76_users` where user_pseudo = :pseudo';

    // on prepare la requete pour se premunir des injection SQL
    $stmt = $pdo->prepare($sql);

    // on bind la valeur du post
    $stmt->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);

    $stmt->execute();

    // on compte le nombre de ligne pour savoir si ya un autre pseudo utiliser
    $stmt->rowCount() == 0 ? $found = false : $found = true;

    $pdo = '';

    if (isset($_POST['pseudo'])) {
        if (empty($_POST['pseudo'])) {
            $error['pseudo'] = 'Pseudo obligatoire';
        } else if (!preg_match($regex_pseudo, $_POST['pseudo'])) {
            $error['pseudo'] = 'Caractère non autorisés';
        } else if ($found == true) {
            $error['pseudo'] = 'Pseudo non disponible';
        }
    }

    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // on stock notre requete avec les marqueurs
    $sql = 'SELECT * from `76_users` where user_mail = :email';

    // on prepare la requete pour se premunir des injection SQL
    $stmt = $pdo->prepare($sql);

    // on bind la valeur du post
    $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);

    $stmt->execute();

    // on compte le nombre de ligne pour savoir si ya un autre pseudo utiliser
    $stmt->rowCount() == 0 ? $found = false : $found = true;

    $pdo = '';

    if (isset($_POST['email'])) {
        if (empty($_POST['email'])) {
            $error['email'] = 'Email obligatoire';
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Email non valide';
        } else if ($found == true) {
            $error['email'] = 'Email déjà utilisé';
        }
    }
    if (isset($_POST['mot_de_passe'])) {
        if (empty($_POST['mot_de_passe'])) {
            $error['mot_de_passe'] = 'Mot de passe obligatoire';
        } else if (!preg_match($regex_password, $_POST['mot_de_passe'])) {
            if (strlen($_POST['mot_de_passe']) < 8) {
                $error['mot_de_passe'] = 'Trop petit';
            }
            if (strlen($_POST['mot_de_passe']) > 30) {
                $error['mot_de_passe'] = 'Trop grand';
            }
        }
    }
    if (isset($_POST['confirmation_mdp'])) {
        if (empty($_POST['confirmation_mdp'])) {
            $error['confirmation_mdp'] = 'Mot de passe obligatoire';
        } else if (!preg_match($regex_password, $_POST['confirmation_mdp'])) {
            $error['confirmation_mdp'] = 'le mot de passe est valide';
        } else if (($_POST['confirmation_mdp'] != $_POST['mot_de_passe'])) {
            $error['confirmation_mdp'] = 'les mots de passe ne corresponde pas';
        }
    }
    if (isset($_POST['genre'])) {
        if (empty($_POST['genre'])) {
            $error['genre'] = 'Genre obligatoire';
        }
    }
    if (isset($_POST['date_naissance'])) {
        if (empty($_POST['date_naissance'])) {
            $error['date_naissance'] = 'Date de naissance obligatoire';
        } else if (!preg_match($regex_date, $_POST['date_naissance'])) {
            $error['date_naissance'] = 'Date non valide';
        }

        if (!isset($_POST['condition'])) {
            $error['condition'] = 'Condition obligatoire';
        }
    }
    if (empty($error)) {

        // On se connecte a la base de donnée via pdo = creation instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        // Options avance sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // On stock notre requête avec des marqueurs nominatif
        $sql = 'INSERT INTO 76_users 
    (user_gender,user_lastname,user_firstname,user_pseudo,user_birthdate,user_mail,user_password) 
    VALUE 
    (:gender,:lastname,:firstname,:pseudo,:birthdate,:mail,:password)';


        // On prépare la requête avant de l'exécuter
        $stmt = $pdo->prepare($sql);

        // function permettant de nettoyer les inputs
        function safeInput($string)
        {
            $input = trim($string);
            $input = htmlspecialchars($input);
            return $input;
        }


        $stmt->bindValue("gender", safeInput($_POST["genre"]), PDO::PARAM_STR);
        $stmt->bindValue("lastname", safeInput($_POST["nom"]), PDO::PARAM_STR);
        $stmt->bindValue("firstname", safeInput($_POST["prenom"]), PDO::PARAM_STR);
        $stmt->bindValue("pseudo", safeInput($_POST["pseudo"]), PDO::PARAM_STR);
        $stmt->bindValue("birthdate", safeInput($_POST["date_naissance"]), PDO::PARAM_STR);
        $stmt->bindValue("mail", safeInput($_POST["email"]), PDO::PARAM_STR);
        $stmt->bindValue("password", password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT), PDO::PARAM_STR);

        // On execute la requete
        // $stmt->execute();

        // On test si la requête 
        if ($stmt->execute()) {
            header('Location: controller-confirmation.php');
            exit;
        }

        // on supprime l'instance pdo
        $pdo = '';


        // try {
        //     //code...
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }

        
    }
};




include_once '../View/view-inscription.php';
