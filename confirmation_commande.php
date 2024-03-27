<?php
// Récupération de l'ID de la commande à afficher
if (isset($_GET['commandeId'])) {
    $commandeId = $_GET['commandeId'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "k35gck9e_projets";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération des informations de la commande depuis la base de données
        $sql = "SELECT nom, email, telephone, adresse, date_creation FROM vente_commandes WHERE id = :commandeId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':commandeId', $commandeId);
        $stmt->execute();
        $commande = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fermeture de la connexion à la base de données
        $conn = null;
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        exit();
    }
} else {
    echo "ID de commande non spécifié.";
    exit();
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Confirmation de commande</title>
</head>
<body>
    <div class="container">
        <h1>Confirmation de commande</h1>
        <p>Votre commande a été enregistrée avec succès.</p>

        <h2>Détails de la commande :</h2>

        <p><strong>Nom :</strong> <?php echo $commande['nom']; ?></p>
        <p><strong>Email :</strong> <?php echo $commande['email']; ?></p>
        <p><strong>Téléphone :</strong> <?php echo $commande['telephone']; ?></p>
        <p><strong>Adresse :</strong> <?php echo $commande['adresse']; ?></p>
        <p><strong>Date de création :</strong> <?php echo $commande['date_creation']; ?></p>

        <p>Merci de votre achat !</p>
    </div>

    
    <a href="../index.php">Accueil</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

    <a href="articles.php" class="button">Articles</a>
   
</html>