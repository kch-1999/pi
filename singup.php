<?php
// Démarrer la session pour pouvoir utiliser $_SESSION
session_start();

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "nutrition");

if (!$conn) {
    echo "Échec de la connexion à la base de données.";
    exit;
}

// Vérifie si les champs sont remplis
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];

    // Requête pour trouver l'utilisateur
    $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Vérification du résultat (comme dans ton cours)
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        // Vérifie si le mot de passe est correct (non chiffré ici)
        if ($row['mot_de_passe'] == $mot_de_passe) {
            // Connexion réussie, on enregistre le pseudo dans la session
            $_SESSION['pseudo'] = $row['pseudo'];

            echo "Connexion réussie " . $row['pseudo'] . " !";
            header("Location: utilisateur.html");
            exit;
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }
} else {
    echo "Veuillez remplir tous les champs.";
}

// Fermeture de la connexion
mysqli_close($conn);
?>

