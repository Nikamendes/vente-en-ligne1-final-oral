<?php
require_once './PDO/config.php';

// Traitement de l'inscription du client
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $adresse = htmlspecialchars($_POST['adresse']);

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "k35gck9e_projets";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour l'insertion du client
        $sql = "INSERT INTO client (nom, prenom, email, adresse) VALUES (:nom, :prenom, :email, :adresse)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':adresse', $adresse);

        $stmt->execute();

        // Redirection vers la page de succès ou affichage d'un message de confirmation
        header('Location: client.php');
        exit;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    $conn = null;
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style2.css" rel="stylesheet">
</head>
<body>
    <a href="./index.php">Accueil</a>
    <a href="./front/articles.php">Annuler</a>
    <a href="./front/articles.php">Articles</a>
    <a href="connexion.php">Connexion</a>
    <a href="inscription.php">Inscription</a>
    <div class="container">
        <h1>Inscription</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
    <footer id="monFooter">
<script src="script.js"></script>
</footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>