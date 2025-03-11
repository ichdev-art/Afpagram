<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/home.css">
    <title>Accueil</title>
</head>

<body>
    <div class="container_container">
        <div class="menuleft">
            <h1>Afpagram</h1>
            <ul>
                <li><button>
                        <p><i class="fa-solid fa-house"></i> Accueil</p>
                    </button></li>
                <li><button>
                        <p><i class="fa-solid fa-magnifying-glass"></i> Recherche</p>
                    </button></li>
                <li><button>
                        <a href="../Controller/controller-post.php"><p><i class="fa-solid fa-plus"></i> Créer</p></a>
                    </button></li>
                <li><button>
                        <a href="../Controller/controller-profil.php">
                            <p><i class="fa-solid fa-user"></i> Profil</p>
                        </a>
                    </button></li>
            </ul>
            <ul>
                <li><button>
                        <i class="fa-solid fa-right-from-bracket"></i> <a href="../Controller/controller-deconnexion.php" class="text">Déconnexion</a>
                    </button></li>
            </ul>
        </div>
        <div class="menuright">
            <?= $image ?>
        </div>
        
    </div>
    </div>

    <script src="https://kit.fontawesome.com/8b462dcb6d.js" crossorigin="anonymous"></script>
</body>

</html>