<?php


session_start();

require_once '../../config.php';

// On controle si la personne est bien loggée

if (!isset($_SESSION['user_id'])) {
    header('Location:  ../../index.php');
    exit();
}

$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT * from `76_posts` natural join `76_pictures` where `user_id` = :user_id';

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

$stmt->execute();

$allPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);


$image ="";
$i = 0;

foreach ($allPosts as $post) { 
    
    $image .= "<div class='third'>
    <a href='../Controller/controller-openpost.php?post=" . $post['post_id'] ."'>
        <img src='../../assets/img/users/" . $post['user_id'] . '/' . $post['pic_name'] . "'alt='Une image'>
        </a>
    </div>";
    $i++;
 }

$pdo = '';

?>

<?php include_once '../View/view-profil.php'; ?>
