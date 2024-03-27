<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="style2.css" rel="stylesheet">
    <title>Page de Connexion</title>
</head>
<body>
    <a href="index.php">Accueil</a>
    <a href="./front/articles.php">Annuler</a>
    <a href="./front/articles.php">Articles</a>
    <a href="connexion.php">Connexion</a>
    <a href="inscription.php">Inscription</a>
    
    <h1>Connexion</h1>
    <form method="POST" action="traitement_connexion.php">
        <div class="mb-3">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class= "mb-3">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>