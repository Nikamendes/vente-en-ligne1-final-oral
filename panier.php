<?php
session_start();

// Vérifier si le panier existe
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter un article au panier
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['articleId'])) {
    $articleId = $_GET['articleId'];
    $_SESSION['panier'][$articleId] = true;
}

// Supprimer un article du panier
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['articleId'])) {
    $articleId = $_GET['articleId'];
    unset($_SESSION['panier'][$articleId]);
}

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

// Fonction pour récupérer les articles du panier
function getArticlesFromPanier($conn) {
    $articles = [];

    // Vérifier si le panier existe
    if (!empty($_SESSION['panier'])) {
        $articleIds = array_keys($_SESSION['panier']);
        $articleIdsPlaceholder = implode(',', $articleIds);

        $sql = "SELECT id, nom, prix, description FROM vente_articles WHERE id IN ($articleIdsPlaceholder)";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $articles = $result;
        }
    }

    return $articles;
}

// Fonction pour récupérer tous les articles pour le formulaire de commande
function getAllArticles($conn) {
    $articles = [];

    $sql = "SELECT id, nom, prix, description FROM vente_articles";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $articles = $result;
    }

    return $articles;
}

// Récupération des articles sélectionnés depuis la base de données
$panierArticles = getArticlesFromPanier($conn);

// Récupérer tous les articles pour le formulaire de commande
$articles = getAllArticles($conn);

$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style2.css" rel="stylesheet">
    <title>Panier</title>
</head>
    <style>

h1{
    text-align: center;
}


      form {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1px; 
    margin-top: 0px;
    margin-bottom: 150;
}


    </style>
</head>
<body>
    <h1>Panier</h1>

    <?php if (count($panierArticles) > 0) : ?>
        <h2>Articles sélectionnés :</h2>
        <ul>
            <?php foreach ($panierArticles as $article) : ?>
                <li><?php echo $article['nom']; ?> - Prix : <?php echo $article['prix']; ?> €</li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>

    <h2>Passer une commande :</h2>
    <form action="process_commandes.php" method="post">
      <div class="mb-3">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>
      </div>
        <br><br>
        <div class="mb-3">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required>
        </div>
        <br><br>
        <div class="mb-3">
        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" required>
        </div>
        <br><br>
         <div class="mb-3">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
         </div>
        <br><br>
        <div class="mb-3">
        <label for="telephone">Téléphone :</label>
        <input type="text" name="telephone" id="telephone" required>
        </div>
        <br><br>
        <label for="article">Sélectionnez un article :</label>
        <select name="article" id="article">
            <?php foreach ($articles as $article) : ?>
                <option value="<?php echo $article['id']; ?>"><?php echo $article['nom']; ?> - Prix : <?php echo $article['prix']; ?> €</option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <input type="submit" value="Passer la commande">
    </form>
    <a href="../index.php">Accueil</a>
</body>
</html>
 