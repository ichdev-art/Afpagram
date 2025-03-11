<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Inscription</title>
</head>



<body>
    <h1>Formulaire d'inscription</h1>
    <form id="inscriptionF" action="" method="POST" novalidate>
        <div class="container">
            <label for="nom">Nom :</label>
            <span><?= $error['nom'] ?? '' ?></span>
            <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? '' ?>" required>
        </div>

        <div class="container">
            <label for="prenom">Prénom :</label>
            <span><?= $error['prenom'] ?? '' ?></span>
            <input type="text" name="prenom" id="prenom" value="<?= $_POST['prenom'] ?? '' ?>" required>
        </div>

        <div class="container">
            <label for="pseudo">Pseudo :</label>
            <span><?= $error['pseudo'] ?? '' ?></span>
            <input type="text" name="pseudo" id="nom" value="<?= $_POST['pseudo'] ?? '' ?>" required>
        </div>

        <div class="container">
            <label for="mail">E-mail :</label>
            <span><?= $error['email'] ?? '' ?></span>
            <input type="email" name="email" id="mail" value="<?= $_POST['email'] ?? '' ?>" required>
        </div>

        <div class="container">
            <label for="mdp">Mot de passe :</label>
            <span><?= $error['mot_de_passe'] ?? '' ?></span>
            <input type="password" name="mot_de_passe" id="mdp" required>
        </div>

        <div class="container">
            <label for="c_mdp">Confirmation mot de passe :</label>
            <span><?= $error['confirmation_mdp'] ?? '' ?></span>
            <input type="password" name="confirmation_mdp" id="c_mdp" required>
        </div>

        <div class="container">
            <label for="ddn">Date de naissance :</label>
            <span><?= $error['date_naissance'] ?? '' ?></span>
            <input type="date" name="date_naissance" id="ddn" value="<?= $_POST['date_naissance'] ?? '' ?>" required>
        </div>

        <div class="container">
            <label for="genre">Genre :</label>
            <span><?= $error['genre'] ?? ''?></span>
            <select id="genre" name="genre" required>
                <option value="" selected>Choisir</option>
                <option value="homme" <?=isset ($_POST['genre']) && $_POST['genre'] == 'homme' ? 'selected' : '' ?>>Homme</option>
                <option value="femme" <?=isset ($_POST['genre']) && $_POST['genre'] == 'femme' ? 'selected' : '' ?>>Femme</option>
                <option value="autre" <?=isset ($_POST['genre']) && $_POST['genre'] == 'autre' ? 'selected' : '' ?>>Autre</option>
            </select>
        </div>

        <div class="container">
            <label for="cU">Conditions d'utilisation :</label>
            <span><?= $error['condition'] ?? ''?></span>
            <input type="checkbox" name="condition" id="cU" required>
        </div>

       <input type="submit" value="Valider" id="valider">
        
    </form>
    <a href="../Controller/controller-connexion.php"><button class="retour">Retour</button></a>
<!-- 
    <script>
        document.getElementById("inscriptionF").addEventListener("submit", function(e) {
            e.preventDefault();

            document.body.classList.add("fade-out", "hidden");
            setTimeout(() => {
                window.location.href = "confirmation.php";
            }, 500);
        });
    </script> -->
</body>

</html>