<?php

session_start();
require_once '../../config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location:  ../../index.php');
    exit();
}

$error = [];



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['dossier'])) {
        if (empty($_FILES['dossier']['name'])) {
            $error['dossier'] = 'Photo obligatoire';
        }
    }
    if (isset($_POST['commentaire'])) {
        if (empty($_POST['commentaire'])) {
            $error['commentaire'] = 'Commentaire obligatoire';
        }
    }
    
    $target_dir = "../../assets/img/users/" . $_SESSION['user_id'] . "/";
    $target_file = $target_dir . uniqid() . "_" . basename($_FILES["dossier"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(is_dir($target_dir)){
        echo "Le dossier existe déjà";
    }else{
        mkdir($target_dir);
    }

    if(!empty($_FILES['dossier']['tmp_name']) && !empty($_POST["commentaire"])){

        if ($uploadOk == 0) {
            echo "Désole, votre fichier n'a pas été téléchargé.";
          } else {
            if (move_uploaded_file($_FILES["dossier"]["tmp_name"], $target_file)) {
              echo "Le fichier ". htmlspecialchars(basename( $_FILES["dossier"]["tmp_name"])). " a été téléchargé.";
            } else {
              echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
            }
          }

          var_dump($uploadOk);

        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);


        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    
        $sql = 'INSERT INTO 
        `76_posts`
        (
        `post_timestamp`,
        `post_description`,
        `post_private`,
        `user_id`
        ) 
        VALUE 
        (:date,:description,:private,:user_id)';
    
    
        $stmt = $pdo->prepare($sql);
    
    
    
        $stmt->bindValue(":date", time(), PDO::PARAM_STR);
        $stmt->bindValue(":description", $_POST["commentaire"], PDO::PARAM_STR);
        $stmt->bindValue(":private", isset($_POST["condition"]) ? 1 : 0, PDO::PARAM_INT);
        $stmt->bindValue(":user_id", $_SESSION["user_id"], PDO::PARAM_STR);
    
        $stmt->execute();
    
        $id = $pdo->lastInsertId();
    
    
        $sql = 'INSERT into 
        `76_pictures` 
        (
        `pic_name`,
        `post_id`
        ) 
        value 
        (:pic_name,:post_id)';
    
    
        $stmt = $pdo->prepare($sql);
    
    
    
        $stmt->bindValue(":pic_name", $_FILES["dossier"]["name"], PDO::PARAM_STR);
        $stmt->bindValue(":post_id", $id, PDO::PARAM_STR);
      
        // $stmt->execute();
      
      
      
      
        if ($stmt->execute()) {
        header('Location: controller-profil.php');
        exit;
    }
  $pdo = '';
  }
}
include_once '../View/view-post.php';
