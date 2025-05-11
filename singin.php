<?php
// Démarrer la session pour utiliser $_SESSION
session_start();

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "nutrition");

if (!$conn) {
    echo "Échec de la connexion à la base de données.";
    exit;
}

// Vérification et insertion
if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Mot de passe sans hashage

    $sql = "INSERT INTO utilisateur (pseudo, email, mot_de_passe)
            VALUES ('$pseudo', '$email', '$password')";
    
    if (mysqli_query($conn, $sql)) {
        // Enregistrer le pseudo dans la session
        $_SESSION['pseudo'] = $pseudo;

        // Rediriger vers la page utilisateur.html
        header("Location: utilisateur.html");
        exit;
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
} else {
    echo "Tous les champs du formulaire doivent être remplis.";
}

// Fermeture de la connexion
mysqli_close($conn);
?>
