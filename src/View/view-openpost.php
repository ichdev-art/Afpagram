<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/openpost.css">
    <title>open post</title>
</head>

<body>
    <?php include_once '../../templates/nav.php' ?>
    <div class='container'>
        <div class="miniContainer">
            <div class='title'>
                <img src='/LogoChaine.png' alt='profil'>
                <h1><?= $uniquePost['user_pseudo'] ?></h1>
                <p><?= date('d/m/Y H:i', $uniquePost['post_timestamp']) ?></p>
            </div>
            <div class='public'>
                <img src="../../assets/img/users/<?= $uniquePost['user_id'] ?>/<?= $uniquePost['pic_name'] ?>" alt=''>
            </div>
            <div class='icon'>
                <p><?= $nbLikes ?> <?= toutlesLikes($uniquePost['post_id'], $pdo) ? " <i class='fa-solid fa-heart iconCoeur'></i>" : " <i class='fa-regular fa-heart'></i></p>" ?>
                <p><?= $nbComments ?> <i class='fa-regular fa-comment'></i></p>
            </div>
        </div>
        <div class='commentaire'>
            <p><?= $uniquePost['user_pseudo'] ?> : <span><?= $uniquePost['post_description'] ?></span></p>
        </div>
        <div class='moreInfos'>
            <p><?= $commentaire ?></p>
            <div>
            <form  class="addcom" action='' method="post" novalidate>
                <input type='text' name="com_text" placeholder=' Ajouter un commentaire'>
            </form>
            <p class="error"><?= $error["com_text"] ?? '' ?></p>
        </div>
        </div>
    </div>


    <script src=" https://kit.fontawesome.com/8b462dcb6d.js" crossorigin="anonymous"></script>

</body>

</html>