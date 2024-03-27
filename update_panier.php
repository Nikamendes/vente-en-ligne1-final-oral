<?php
session_start();

// Vérification de l'authentification du client
if (!isset($_SESSION['client'])) {
    header('Location: connexion.php');
    exit;
}

// Récupération de l'action (add ou delete) depuis la requête AJAX
$action = $_GET['action'];

// Récupération des informations du client depuis la session
$client = $_SESSION['client'];

// Mise à jour de la base de données en fonction de l'action
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "k35gck9e_projets";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mise à jour de la colonne "panier" dans la table "client"
    if ($action === 'add') {
        $articleNumber = $client['panier'] + 1;
    } elseif ($action === 'delete') {
        $articleNumber = max(0, $client['panier'] - 1);
    }

    // Requête SQL pour mettre à jour le panier du client
    $sql = "UPDATE client SET panier = :panier WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':panier', $articleNumber, PDO::PARAM_INT);
    $stmt->bindParam(':id', $client['id'], PDO::PARAM_INT);
    $stmt->execute();

    // Réponse de succès pour la requête AJAX
    echo "Mise à jour du panier effectuée avec succès";
} catch (PDOException $e) {
    // Réponse d'erreur pour la requête AJAX
    echo "Erreur de connexion : " . $e->getMessage();
}
?>