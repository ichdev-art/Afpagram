<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/connexion.css">
    <title>Connexion</title>
</head>

<body>
    <h1>Connexion</h1>
    <form id="connexion" method="POST" novalidate>
        <div class="label">
        <label>Identifiant :</label>
        <span><?= $error['email'] ?? '' ?></span>
            <input type="text" name="email" id="mail" value="<?= $_POST['email'] ?? '' ?>" required>
        </div>
        <div class="label">
        <label>Mot de passe :</label>
        <span><?= $error['mdp'] ?? '' ?></span>
            <input type="password" name="mdp" id="mdp" required>
        </div>
        <span><?= $error['connexion'] ?? '' ?></span>
        <div class="label">
        <input type="submit" value="Connexion" id="valider">
    </div>
    </form>
    <p>Pas encore de compte ? <a href="./controller-inscription.php" id="connexionn">Inscrivez-vous</a></p>

    <!-- <script>
        document.getElementById("connexionn").addEventListener("click", function (e) {
            e.preventDefault();

            document.body.classList.add("fade-out", "hidden");
            setTimeout(() => {
                window.location.href = "inscription.php";
            }, 500);
        });
    </script> -->
</body>

</html>