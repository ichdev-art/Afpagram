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

foreach ($allPosts as $value) {
    $image .= "<div class='container'>
                <div class='title'>
                    <img src='/LogoChaine.png' alt='profil'>
                    <h1> " . $value['user_pseudo'] . "</h1>
                    <p> " . date('d/m/Y H:i', $value['post_timestamp']) . "</p>
                </div>
                <div class='public'>
                    <img src='../../assets/img/users/" . $value['user_id'] . "/" . $value['pic_name'] . "' alt=''>
                </div>
                <div class='icon'>
                <p><i class='fa-regular fa-heart'></i></p>
                <p><i class='fa-regular fa-comment'></i></p>
                </div>
                <div class='like'>
                    <p>Nombre de like</p>
                </div>
                <div class='commentaire'>
                <p> " . $value['user_pseudo'] . " : " . $value['post_description'] . " </p>
                </div>
                <div class='moreInfos'>
                    <a href=''>Afficher tout les commentaires</a>
                </div>
                <input type='text' placeholder=' Ajouter un commentaire'>
            </div>";
}

$pdo = '';


?>


<?php include_once '../View/view-home.php';
?>