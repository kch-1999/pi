<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['pseudo'])) {
    echo "Veuillez vous connecter pour accéder à cette page.";
    exit();
}

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "nutrition");

if (!$conn) {
    echo "Échec de la connexion à la base de données.";
    exit();
}

// Récupérer le pseudo de l'utilisateur connecté
$pseudo = $_SESSION['pseudo'];

// Récupérer le nom de la recette envoyée par le formulaire
$recette = $_POST['recette'];

// Récupérer les informations de la recette depuis la base de données
$sql_recette = "SELECT * FROM recettes WHERE nom = '$recette'";
$result_recette = mysqli_query($conn, $sql_recette);

// Assumer que les données de la recette existent et les récupérer
$row = mysqli_fetch_assoc($result_recette);

// Récupérer les informations de la recette
$calories = $row['calories'];
$lipides = $row['lipides'];
$glucides = $row['glucides'];

// Insérer les données dans le suivi_nutritionnel
$date = date("Y-m-d");
$sql_insert = "INSERT INTO suivi_nutritionnel (id_utilisateur, date, calories, lipides, glucides) 
               VALUES ('$pseudo', '$date', '$calories', '$lipides', '$glucides')";

if (mysqli_query($conn, $sql_insert)) {
    echo "Recette ajoutée au suivi nutritionnel avec succès !";
} else {
    echo "Erreur lors de l'ajout au suivi nutritionnel : " . mysqli_error($conn);
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
