<?php

session_start();

// Vérification de l'envoi du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire avec la protection contre les injections SQL
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);

    // Vérification des informations de connexion dans la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "k35gck9e_projets";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour vérifier les informations de connexion
        $sql = "SELECT * FROM vente_client WHERE nom = :nom AND email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Vérification du résultat de la requête
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // Informations de connexion valides
            $_SESSION['client'] = $result; // Stockage des données du client dans la session
            header('Location: client.php');
            exit;
        } else {
            // Informations de connexion invalides
            echo "Nom d'utilisateur ou email incorrect.";
        }
    } catch(PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    $conn = null;
}