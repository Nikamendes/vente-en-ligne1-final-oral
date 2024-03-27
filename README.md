# Title du projet
Projet de Vente en ligne

# Introduction
Ce projet est une application de vente en ligne, développé en PHP, HTML et une base de données MySQL. Il permet aux utilisateurs de se connecter, s'inscrire et voire les articles, de gérer leur panier et faire des commandes.

# Contenu du projet
-index.php: Page d'accueil.
-inscription.php: Page qui permet aux utilisateurs de s'inscrire.
-connexion.php: Page pour le utilisateur se connecter.
-client.php: Page affichant les informations du client et permet de gérer le panier.
-supprimer_client.php: Page qui permet de supprimer un client de la base de données.
-modifier_clent.php: Page qui permet de modifier les informations du client.
-traitement_connexion.php: Page traitant le formulaire d'inscription.
-ajouter_panier.php: gérer les operations du panier(ajout ou supprimer);
-articles.php: Page pour afficher les articles.
-confirmation_commande:Page qui affiche si la commande est bien enregistrer ou une erreur.
-panier.php: Page qui affiche le panier du client.
-PDO/config.php: connexion a la base de données.

# configuration a la base de données
$servername = "localhoste"
$username= "root;
$password= "";
$dbname=" k35gck9e_projets";

Le projet utilise plusieurs tables pour stockers les données:

 Table vente_articles:
        id int(11) NOT NULL,
        nom varchar(11) NOT NULL,
        prix varchar(11) NOT NULL,
        description varchar(11) NOT NULL
   
Table vente_client:
        id int(11) NOT NULL,
        nom varchar(10) NOT NULL,
        prenom varchar(10) NOT NULL,
        email varchar(15) NOT NULL,
        adresse varchar(20) NOT NULL,
        panier varchar(10) NOT NULL

Table vente_commandes:    
        id int(11) NOT NULL,
        nom varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        telephone varchar(20) NOT NULL,
        adresse varchar(255) NOT NULL,
        
Table commande_articles:
        id int(11) NOT NULL,
        commande_id int(11) DEFAULT NULL,
        article_id int(11) DEFAULT NULL
       

# Fonctionnalités
°Inscription et connexion: les utilisateurs peuvent s'inscrire en fournissant leur nom, prénom, adresse et email. Il peuvent également se connecter en fournissant leur nom et leur email.

°Gestion du panier: Les utilisateurs peuvent ajouter ou supprimer des articles de l'eurs panier.

°Consultation d'articles: Les utilisateurs peuvent consulter les articles disponibles.

°Modification des informations: Les utilisateurs peuvent modifier ses données.

# Configuration Requise
-Serveur Web (XAMPP recommandé)
-PHP 
-MySQL

# Installation et Utilisation en Local avec XAMPP
°Clonez ce dépôt dans le dossier htdocs de votre installation XAMPP (exemple : C:\xampp\htdocs sous Windows).
°Lancez XAMPP et démarrez les services Apache et MySQL.
°Créez une base de données k35gck9e_projets.
°Accédez à l'application via votre navigateur en utilisant l'URL correspondante (exemple, http://localhost/vente-en-ligne1).






