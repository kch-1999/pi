<?php
$pseudo = trim($_POST['username']); 


$conn = new mysqli("localhost", "root", "", "nutrition");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$sql = "DELETE FROM utilisateur WHERE pseudo = '$pseudo'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suppression de compte</title>
    <style>
        body {
            background-color: #121212;
            color: white;
            font-family: Arial;
            text-align: center;
            padding: 50px;
        }
    </style>
</head>
<body>
    <h1>Suppression du compte de <?php echo $pseudo; ?></h1>
    <?php
    if ($result) {
        echo "<p>Compte supprimé avec succès.</p>";
    } else {
        echo "<p>Erreur lors de la suppression.</p>";
    }
    ?>
</body>
</html>
