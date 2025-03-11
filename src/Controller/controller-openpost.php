<?php

use function PHPSTORM_META\sql_injection_subst;

session_start();
require_once '../../config.php'; 

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/');
    exit;
}

if (isset($_GET['post'])) {

    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT post_description, pic_name, user_pseudo, post_timestamp, user_id FROM 76_posts
        NATURAL JOIN 76_pictures
        NATURAL JOIN 76_users
        WHERE post_id = :pic_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pic_id', $_GET['post'], PDO::PARAM_STR);

    $stmt->execute();

    $uniquePost = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT count(*) from 76_likes where post_id = :post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':post_id', $_GET['post'], PDO::PARAM_STR);
    $stmt->execute();
    $nbLikes = $stmt->fetch(PDO::FETCH_ASSOC);
    $nbLikes = $nbLikes['count(*)'];  
    
    $sql = "SELECT count(*) from 76_comments where post_id = :post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':post_id', $_GET['post'], PDO::PARAM_STR);
    $stmt->execute();
    $nbComments = $stmt->fetch(PDO::FETCH_ASSOC);
    $nbComments = $nbComments['count(*)'];

    $sql = "SELECT user_pseudo, com_text FROM 76_comments
        INNER JOIN 76_users
        ON 76_comments.user_id = 76_users.user_id
        WHERE post_id = :post_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':post_id', $_GET['post'], PDO::PARAM_STR);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    $commentaire = '';
    foreach ($comments as $key => $value) {
        $commentaire .= "<p>" . $value['user_pseudo'] . " : " . $value['com_text'] . "</p>";
    }


    $pdo = '';


}


?>

<?php include_once '../View/view-openpost.php'; ?>