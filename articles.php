<?php

session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "k35gck9e_projets";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Récupération des articles depuis la base de données
$sql = "SELECT id, nom, prix, description FROM vente_articles";
$stmt = $conn->prepare($sql);

$articles = [];
if ($stmt->execute()) {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $articles = $result;
}

$conn = null;

// Ajouter l'article au panier
if (isset($_GET['action']) && isset($_GET['articleId']) && $_GET['action'] === 'add') {
    $articleId = $_GET['articleId'];
    $_SESSION['panier'][] = $articleId;
    
    // Rediriger vers la page panier.php après l'ajout
    header("Location: panier.php");
    exit();
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <style>
        body {
            background: lightgray;
        }

        .article-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .article-image {
            width: 200px;
            height: 200px;
            margin-right: 20px;
            border-radius: 10px;
        }

        .article-info {
            flex-grow: 1;
        }

        h1 {
            text-align: center;
        }

        footer {
            margin-left: 400px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
<nav>
    <a href="panier.php">Voir le panier</a>
    <a href="../index.php">Accueil</a>
</nav>
<h1>Les articles disponibles</h1>

<div class="articles">
    <?php foreach ($articles as $article) { ?>
        <div class="article-container">
            <div class="article-image">
                <?php if ($article['id'] == 1) { ?>
                    <img src="https://cdn.leroymerlin.com.br/categories/aspirador_de_po_46f7_300x300.jpg" alt="ASPIRADOR DE PÓ: Vertical, Portátil, Pó e Água - Leroy Merlin" style="width: 100%; height: 100%;">
                <?php } elseif ($article['id'] == 2) { ?>
                    <img src="https://media.adeo.com/marketplace/MKP/84863191/41c6e209e1934a2d659d1ee445939e69.jpeg?width=650&height=650&format=jpg&quality=80&fit=bounds" alt="Tapis" style="width: 100%; height: 100%;">
                <?php } elseif ($article['id'] == 3) { ?>
                    <img src="table.jpg" alt="Table et chaises" style="width: 100%; height: 100%;">
                <?php } ?>
            </div>
            <div class="article-info">
                <h2><?php echo $article['nom']; ?></h2>
                <p>Prix : <?php echo $article['prix']; ?>£</p>
                <p>Description : <?php echo $article['description']; ?></p>
                <a href="articles.php?action=add&articleId=<?php echo $article['id']; ?>" class="btn-panier">Ajouter au panier</a>
            </div>
        </div>
    <?php } ?>
</div>

<footer><p>Tous les articles sont basés sur la qualité de bien servir les clients</p>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>