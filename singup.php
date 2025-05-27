<?php

session_start();


$conn = mysqli_connect("localhost", "root", "", "nutrition");

if (!$conn) {
    echo "Échec de la connexion à la base de données.";
    exit;
}


if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];

    
    $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

   
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        
        if ($row['mot_de_passe'] == $mot_de_passe) {
            
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


mysqli_close($conn);
?>

