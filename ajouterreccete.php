<?php

$conn = mysqli_connect("localhost", "root", "", "nutrition");

if (!$conn) {
    echo "Échec de la connexion à la base de données.";
    exit;
}


if (!empty($_POST['nom']) && !empty($_POST['ingredients']) && !empty($_POST['calories']) && !empty($_POST['lipides']) && !empty($_POST['glucides'])) {
    $nom = $_POST['nom'];
    $ingredients = $_POST['ingredients'];
    $calories = $_POST['calories'];
    $lipides = $_POST['lipides'];
    $glucides = $_POST['glucides'];

    $sql = "INSERT INTO recettes (nom, ingredients, calories, lipides, glucides)
            VALUES ('$nom', '$ingredients', '$calories', '$lipides', '$glucides')";
    mysqli_query($conn, $sql);
} else {
    echo "Tous les champs du formulaire doivent être remplis.";
}


$sql = "SELECT * FROM recettes";
$result = mysqli_query($conn, $sql);

echo "<table border='1'>";
echo "<tr><th>Nom</th><th>Ingrédients</th><th>Calories</th><th>Lipides</th><th>Glucides</th></tr>";

foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['nom'] . "</td>";
    echo "<td>" . $row['ingredients'] . "</td>";
    echo "<td>" . $row['calories'] . "</td>";
    echo "<td>" . $row['lipides'] . "</td>";
    echo "<td>" . $row['glucides'] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
