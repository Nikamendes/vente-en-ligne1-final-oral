<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "k35gck9e_projets";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $articles = $_POST['articles'];

    // Insertion des informations de commande dans la base de données
    $sql = "INSERT INTO vente_commandes (nom, email, telephone, adresse, date_creation) VALUES (:nom, :email, :telephone, :adresse, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->execute();

    // Récupération de l'ID de la dernière commande insérée
    $lastCommandeId = $conn->lastInsertId();

    // Fermeture de la connexion à la base de données
    $conn = null;

    // Redirection vers la page de confirmation de commande avec l'ID de la commande
    header("Location: confirmation_commande.php?commandeId=$lastCommandeId");
    exit();
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>