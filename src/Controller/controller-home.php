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

/**
 * Permet de compter les likes d'une publication
 * 
 * @param INT $post_id l'ID du post
 * @return INT $nbLikes Nombres de likes sur le post
 * 
 */
function montrerlikes($post_id,$pdo) {

$sql = "SELECT count(like_id) `likes` from 76_likes where post_id = $post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $nbLikes = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = "";
    return $nbLikes;
}

 /**
 * Permet de compter les commentaires d'une publication
 * 
 * @param INT $post_id l'ID du post
 * @return INT $nbComments Nombres de likes sur le post
 * 
 */  
function montrercomments($post_id,$pdo) {
    $sql = "SELECT count(com_id) `comments` from 76_comments where post_id = $post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $nbComments = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = "";
    return $nbComments;

}

require_once '../../function.php';


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
                <p>" . montrerlikes($value["post_id"],$pdo)['likes'] . (toutlesLikes($value['post_id'], $pdo) ? " <i class='fa-solid fa-heart iconCoeur'></i>" : " <i class='fa-regular fa-heart'></i></p>") . "
                <p>" . montrercomments($value["post_id"], $pdo)['comments'] . " <i class='fa-regular fa-comment'></i></p>
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