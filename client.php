<?php
require_once './PDO/config.php';
session_start();

// Vérification de l'authentification du client
if (!isset($_SESSION['client'])) {
    header('Location: connexion.php');
    exit;
}

// Récupération des informations du client depuis la session
$client = $_SESSION['client'];

// Traitement de la suppression des informations du client
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // Suppression des informations du client dans la base de données
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour supprimer les informations du client
            $sql = "DELETE FROM vente_client WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $client['id'], PDO::PARAM_INT);
            $stmt->execute();

            // Suppression des informations dans la session
            unset($_SESSION['client']);

            // Redirection vers la page de connexion ou affichage d'un message de confirmation
            header('Location: connexion.php');
            exit;
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="style2.css" rel="stylesheet">
    <title>Page Client</title>
</head>
<body>
    <h1>Informations du client</h1>
    <ul>
        <li>ID : <?php echo htmlspecialchars($client['id']); ?></li>
        <li>Nom : <?php echo htmlspecialchars($client['nom']); ?></li>
        <li>Prénom : <?php echo htmlspecialchars($client['prenom']); ?></li>
        <li>Email : <?php echo htmlspecialchars($client['email']); ?></li>
        <li>Adresse : <?php echo htmlspecialchars($client['adresse']); ?></li>
        <li>Panier : <?php echo htmlspecialchars($client['panier']); ?></li>
    </ul>
    <form method="POST" action="supprimer_client.php">
        <button type="submit" name="delete">Supprimer le client</button>
    </form>

    <a href="modifier_client.php?id=<?php echo htmlspecialchars($client['id']); ?>">Modifier</a>

    <a href="./front/articles.php">Articles</a>
    
    <a href="../index.php">Accueil</a>
<footer id="monFooter">
<script src="script.js"></script>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
    </html>