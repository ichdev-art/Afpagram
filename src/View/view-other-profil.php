<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/profil.css">
    <title>Profil</title>
</head>

<body>
    <div class="container_container">
        <?php include '../../templates/nav.php'; ?>
        <div class="menuright">
            <div class="container">
                <div class="leftInfos">
                    <img src="/LogoChaine.png" alt="profil">
                </div>
                <div class="rightInfos">
                    <div class="title">
                        <h1><?= $uniqueUser[0]['user_pseudo'] ?></h1>
                        <button>
                            <p>Modifier profil</p>
                        </button>
                        <button><a href="../Controller/controller-deconnexion.php">
                                <p>Deconnexion</p>
                            </a>
                        </button>
                    </div>
                    <div class="info">
                        <p><?= $i ?> Posts</p>
                        <p>10 Followers</p>
                        <p>100 Suivi</p>
                    </div>
                </div>
            </div>
            <div class="publication">
                <h2>Publications</h2>
            </div>
            <div class="post">
                <?= $image; ?>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/8b462dcb6d.js" crossorigin="anonymous"></script>
</body>

</html>