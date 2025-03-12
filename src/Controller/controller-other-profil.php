<?php


session_start();

require_once '../../config.php';

// On controle si la personne est bien loggée

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit();
}

if (isset($_GET['user'])) {

    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT
            *
        FROM
            `76_posts` 
        natural join `76_pictures`
        natural join `76_users`
        WHERE user_id = :user_id 
        ORDER BY
            post_timestamp DESC
           ;";


$stmt = $pdo->prepare($sql);

$stmt->bindValue(':user_id', $_GET['user'], PDO::PARAM_INT);

$stmt->execute();

$uniqueUser = $stmt->fetchAll(PDO::FETCH_ASSOC);



if(!$uniqueUser){
    header('Location: ../View/view-introuvable.php');
    exit();
}

$image ="";
$i = 0;

foreach ($uniqueUser as $post) { 
    
    $image .= "<div class='third'>
    <a href='../Controller/controller-openpost.php?post=" . $post['post_id'] ."'>
        <img src='../../assets/img/users/" . $post['user_id'] . '/' . $post['pic_name'] . "'alt='Une image'>
        </a>
    </div>";
    $i++;
 }

$pdo = '';
}
?>

<?php include_once '../View/view-other-profil.php'; ?>
