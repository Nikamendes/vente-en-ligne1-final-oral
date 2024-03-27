<?php
// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="k35gck9e_projets";

try {
    $conn = new PDO("mysql:host=$servername;dbname=k35gck9e_projets", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql_create_vente_articles = "
    CREATE TABLE IF NOT EXISTS vente_articles (
        id int(11) NOT NULL,
        nom varchar(11) NOT NULL,
        prix varchar(11) NOT NULL,
        description varchar(11) NOT NULL
    )";

    $conn->exec($sql_create_vente_articles);

    $sql_create_vente_client = "
    CREATE TABLE IF NOT EXISTS vente_client (
        id int(11) NOT NULL,
        nom varchar(10) NOT NULL,
        prenom varchar(10) NOT NULL,
        email varchar(15) NOT NULL,
        adresse varchar(20) NOT NULL,
        panier varchar(10) NOT NULL
    )";

    $conn->exec($sql_create_vente_client);

    $sql_create_vente_commandes = "
    CREATE TABLE IF NOT EXISTS vente_commandes (
        id int(11) NOT NULL,
        nom varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        telephone varchar(20) NOT NULL,
        adresse varchar(255) NOT NULL,
        date_creation timestamp NOT NULL DEFAULT current_timestamp()
        )";

        $conn->exec($sql_create_vente_commandes);

    $sql_create_commandes_articles = "
    CREATE TABLE IF NOT EXISTS commandes_articles(
        id int(11) NOT NULL,
        commande_id int(11) DEFAULT NULL,
        article_id int(11) DEFAULT NULL
        )";

        $conn->exec($sql_create_commandes_articles);

} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
