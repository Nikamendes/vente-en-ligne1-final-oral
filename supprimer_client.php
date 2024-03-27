<?php
// fichier qui contient la configuration de la base de données
require_once './PDO/config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Connexion à la base de données
        $conn = new PDO("mysql:host=$servername;dbname=articles", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête de suppression
        $query = "DELETE FROM vente_client WHERE id = ?";
        $stmt = $conn->prepare($query);

        // Exécution de la requête de suppression
        $stmt->execute([$id]);

        // Redirection vers la page de liste des agents après la suppression
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style1.css" rel="stylesheet">
    <title>Supprimer Client</title>
</head>

<body>
   
<h1>Supprimer un Client</h1>

<?php if (isset($_GET['id'])): ?>
    <form method="POST" action="">
       
        
        <button type="submit" class="btn btn-danger">Supprimer</button>
        <a href="./front/articles.php" class="btn btn-secondary">Annuler</a>
    </form>
<?php else: ?>
    <p>Une erreur s'est produite. </p>
    <a href="client.php" class="btn btn-primary">Retour Client</a>
<?php endif; ?>

<footer>SKG site &copy; 2023</footer>
  
<!-- Ici on va inclure tous les scripts qu'on veut utiliser, comme JQuery, Bootstrap, etc -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>