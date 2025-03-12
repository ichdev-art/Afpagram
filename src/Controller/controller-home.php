<?php
session_start();

require_once '../../config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location:  ../../index.php');
    exit();
}

$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT * FROM 76_posts NATURAL JOIN 76_pictures NATURAL JOIN 76_users where user_id in (
(SELECT group_concat(fav_id) from 76_favorites where user_id = :user_id
GROUP BY user_id),:user_id
)';

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

$stmt->execute();

$allPosts = $stmt->fetchAll();

$image = "";
$i = 0;

// $sql = "SELECT count(*) from 76_likes where post_id = :post_id";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':post_id', $_SESSION['post_id'], PDO::PARAM_STR);
//     $stmt->execute();
//     $nbLikes = $stmt->fetch(PDO::FETCH_ASSOC);
//     $nbLikes = $nbLikes['count(*)'];  
    
//     $sql = "SELECT count(*) from 76_comments where post_id = :post_id";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':post_id', $_POST['post_id'], PDO::PARAM_STR);
//     $stmt->execute();
//     $nbComments = $stmt->fetch(PDO::FETCH_ASSOC);
//     $nbComments = $nbComments['count(*)'];


foreach ($allPosts as $value) {
    $image .= "<div class='container'>
                <div class='title'>
                    <img src='/LogoChaine.png' alt='profil'>
                    <h1><a href='controller-other-profil.php?user=" . $value['user_id'] . " '> " . $value['user_pseudo'] . "</a></h1>
                    <p> " . date('d/m/Y H:i', $value['post_timestamp']) . "</p>
                </div>
                <div class='public'>
                <a href='../Controller/controller-openpost.php?post=" . $value['post_id'] ."'>
                    <img src='../../assets/img/users/" . $value['user_id'] . "/" . $value['pic_name'] . "' alt=''>
                    </a>
                </div>
                <div class='icon'>
                <p><i class='fa-regular fa-heart'></i></p>
                <p><i class='fa-regular fa-comment'></i></p>
                </div>
                <div class='commentaire'>
                <p><span> " . $value['user_pseudo'] . " </span>: " . $value['post_description'] . " </p>
                </div>
            
            </div>";
}




$pdo = '';


?>


<?php include_once '../View/view-home.php';
?>