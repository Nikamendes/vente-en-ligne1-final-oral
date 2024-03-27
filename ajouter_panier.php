<?php
session_start(); // Initialisation de la session

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
    if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
        return array();
    }
    
    $articleIds = implode(',', $_SESSION['panier']);
    
    $sql = "SELECT id, nom, prix, description FROM vente_articles WHERE id IN ($articleIds)";
    $stmt = $conn->prepare($sql);
    
    $articles = [];
    if ($stmt->execute()) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $articles = $result;
    }
    
    return $articles;
}

// Fonction pour supprimer un article du panier
function removeArticleFromPanier($conn, $articleId) {
    if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
        return false;
    }
    
    $index = array_search($articleId, $_SESSION['panier']);
    if ($index !== false) {
        unset($_SESSION['panier'][$index]);
        return true;
    }
    
    return false;
}

// Fonction pour ajouter un article au panier
function addArticleToPanier($conn, $articleId) {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }
    
    if (in_array($articleId, $_SESSION['panier'])) {
        return false;
    }
    
    array_push($_SESSION['panier'], $articleId);
    return true;
}

// Vérifier si une action de suppression est demandée
if (isset($_POST['action']) && $_POST['action'] === 'remove' && isset($_POST['articleId'])) {
    $articleId = $_POST['articleId'];
    
    // Supprimer l'article du panier
    if (removeArticleFromPanier($conn, $articleId)) {
        echo "L'article a été supprimé du panier.";
    } else {
        echo "Une erreur est survenue lors de la suppression de l'article du panier.";
    }
}

// Vérifier si une action d'ajout est demandée
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['articleId'])) {
    $articleId = $_GET['articleId'];
    
    // Ajouter l'article au panier
    if (addArticleToPanier($conn, $articleId)) {
        header("Location: panier.php"); // Rediriger vers la page panier.php
        exit(); // Arrêter l'exécution du script après la redirection
    } else {
        echo "Une erreur est survenue lors de l'ajout de l'article au panier.";
    }
}

// Récupérer les articles du panier
$articles = getArticlesFromPanier($conn);

// Fermer la connexion à la base de données
$conn = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style2.css" rel="stylesheet">
    <title>Panier</title>
</head>
<body>
    <h1>Panier</h1>
    
    <?php if (!empty($articles)) { ?>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <td><?php echo $article['nom']; ?></td>
                    <td><?php echo $article['prix']; ?> €</td>
                    <td><?php echo $article['description']; ?></td>
                    <td>
                        <form method="POST" action="ajouter_panier.php">
                            <input type="hidden" name="action" value="remove" />
                            <input type="hidden" name="articleId" value="<?php echo $article['id']; ?>" />
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a href="?action=cancel">Annuler la commande</a>
    <?php } else { ?>
        <p>Aucun article dans le panier.</p>
    <?php } ?>
    
    <h2>Ajouter un article</h2>
    <form method="GET" action="ajouter_panier.php">
        <input type="hidden" name="action" value="add" />
        <label for="articleId">ID de l'article :</label>
        <input type="text" name="articleId" id="articleId" />
        <button type="submit">Ajouter au panier</button>
    </form>
</body>
</html>