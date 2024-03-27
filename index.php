
<?php 
// Appelle le fichier avec les fonctions à utiliser
require_once 'fonctions.php';

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "k35gck9e_projets";

try {
    $conn = new PDO("mysql:host=$servername;dbname=k35gck9e_projets", $username, $password);
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
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style1.css" rel="stylesheet">
</head>
<body>
  <h1>Les Articles</h1>

  <P> Bienvenue sur notre site</p>
  <div id="transporteur">
     <img class="transporteur"
       src="https://png.pngtree.com/png-vector/20200113/ourlarge/pngtree-flat-transport-van-vector-free-png-icon-download-png-image_2128590.jpg" alt="Van De Transporte Plana Vector Png Grátis Baixar ícone PNG , Clipart De  Carro De Brinquedo, Van De Transporte Plana Vector Png Grátis Baixar ícone  PNG , Carro Imagem PNG e Vetor">

       <div id="block">
     <img class="block"
       src="https://png.pngtree.com/png-vector/20200113/ourlarge/pngtree-flat-transport-van-vector-free-png-icon-download-png-image_2128590.jpg" alt="Van De Transporte Plana Vector Png Grátis Baixar ícone PNG , Clipart De  Carro De Brinquedo, Van De Transporte Plana Vector Png Grátis Baixar ícone  PNG , Carro Imagem PNG e Vetor">
    
   <nav>
    <a href="./front/articles.php">Articles</a>
    <a href="connexion.php">Connecter</a>
    <a href="inscription.php">Inscription</a>
</nav>
<footer id="monFooter">
<script src="script.js"></script>
</footer>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>