<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "nutrition");

if (!$conn) {
    echo "Échec de la connexion à la base de données.";
    exit;
}

if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $sql = "INSERT INTO utilisateur (pseudo, email, mot_de_passe)
            VALUES ('$pseudo', '$email', '$password')";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['pseudo'] = $pseudo;
        header("Location: utilisateur.html");
        exit;
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
} else {
    echo "Tous les champs du formulaire doivent être remplis.";
}

mysqli_close($conn);
?>
