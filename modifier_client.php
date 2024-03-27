<?php

session_start();

// Vérification de l'authentification du client
if (!isset($_SESSION['client'])) {
    header('Location: connexion.php');
    exit;
}

// Récupération des informations du client depuis la session
$client = $_SESSION['client'];

// Traitement de la modification des informations du client
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des nouvelles valeurs des champs
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $panier = htmlspecialchars($_POST['panier']);

    // Mise à jour des informations du client dans la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "k35gck9e_projets";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour mettre à jour les informations du client
        $sql = "UPDATE client SET nom = :nom, prenom = :prenom, email = :email, adresse = :adresse, panier = :panier WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':panier', $panier, PDO::PARAM_STR);
        $stmt->bindParam(':id', $client['id'], PDO::PARAM_INT);
        $stmt->execute();

        // Mise à jour des informations dans la session
        $_SESSION['client']['nom'] = $nom;
        $_SESSION['client']['prenom'] = $prenom;
        $_SESSION['client']['email'] = $email;
        $_SESSION['client']['adresse'] = $adresse;
        $_SESSION['client']['panier'] = $panier;

        // Redirection vers la page client avec un message de confirmation
        header('Location: client.php');
        exit;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    $conn = null;
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="style2.css" rel="stylesheet">
    <title>Modification des informations</title>
</head>
<body>
    <h1>Modification des informations</h1>
    <form method="POST" action="">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo isset($client['nom']) ? $client['nom'] : ''; ?>" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo isset($client['prenom']) ? $client['prenom'] : ''; ?>" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo isset($client['email']) ? $client['email'] : ''; ?>" required>
        </div>
        <div>
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo isset($client['adresse']) ? $client['adresse'] : ''; ?>" required>
        </div>
        <div>
            <label for="panier">Panier :</label>
            <select id="panier" name="panier" required>
                <option value="aspirateur" <?php if (isset($client['panier']) && $client['panier'] === 'aspirateur') echo 'selected'; ?>>Aspirateur</option>
                <option value="tapis" <?php if (isset($client['panier']) && $client['panier'] === 'tapis') echo 'selected'; ?>>Tapis</option>
                <option value="table avec 4 Chaises" <?php if (isset($client['panier']) && $client['panier'] === 'table avec 4 Chaises') echo 'selected'; ?>>Table avec 4 Chaises</option>
            </select>
        </div>

        <button type="submit">Enregistrer les modifications</button>
    </form>
    <a href="../index.php">Accueil</a>
    <footer id="monFooter">
<script src="script.js"></script>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
    </html>