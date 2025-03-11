<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/post.css">
    <title>Création de post</title>
</head>



<body>
    <div class="leftnav">
        <?php include_once '../../templates/nav.php' ?>
    </div>
    <div class="container_container">
        <h1>Créer un post !</h1>
        <form id="inscriptionF" action="" enctype="multipart/form-data" method="POST" novalidate>
            <div class="container">
                <label for="file">Photo :</label>
                <span><?= $error['dossier'] ?? '' ?></span>
                <input type="file" name="dossier" id="file" accept="image/*" value="" required>
            </div>
            <div class="container">
                <label for="comment">Commentaire :</label>
                <span><?= $error['commentaire'] ?? '' ?></span>
                <textarea name="commentaire" id="comment" required></textarea>
            </div>
            <div class="container">
            <label for="cU">Privé :</label>
            <span><?= $error['condition'] ?? ''?></span>
            <input type="checkbox" name="condition" id="cU" required>
        </div>
    <input type="submit" value="Valider" id="valider">
    <a href="../Controller/controller-connexion.php"><button class="retour">Retour</button></a>
</div>
    </form>
    

    <script src="https://kit.fontawesome.com/8b462dcb6d.js" crossorigin="anonymous"></script>
</body>

</html>