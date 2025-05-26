<?php
session_start();

$pseudo = $_SESSION['pseudo'];

$conn = mysqli_connect("localhost", "root", "", "nutrition");

// Récupérer l'id_utilisateur à partir du pseudo
$sql_user = "SELECT id_utilisateur FROM utilisateur WHERE pseudo = '$pseudo'";
$result_user = mysqli_query($conn, $sql_user);

if ($result_user && mysqli_num_rows($result_user) > 0) {
    $row_user = mysqli_fetch_assoc($result_user);
    $id_utilisateur = $row_user['id_utilisateur'];

    // Maintenant récupérer le suivi nutritionnel pour cet utilisateur
    $sql_suivi = "SELECT * FROM suivi_nutritionnel WHERE id_utilisateur = '$id_utilisateur'";
    $result = mysqli_query($conn, $sql_suivi);
} else {
    // Pas d'utilisateur trouvé, initialiser $result à vide
    $result = false;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir Suivi Nutritionnel</title>
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
        }
        h2 {
            margin: 30px 0;
        }
        table {
            width: 80%;
            max-width: 900px;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid #444;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #292929;
        }
        tr:nth-child(even) {
            background-color: #1e1e1e;
        }
        tr:hover {
            background-color: #333;
        }
        footer {
            margin-top: auto;
            padding: 20px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>

<h2>Mon Suivi Nutritionnel</h2>

<?php
if ($result && mysqli_num_rows($result) > 0) {
    echo '<table border="1">';
    echo '<tr>
            <th>Date</th>
            <th>Recette</th>
            <th>Calories</th>
            <th>Lipides</th>
            <th>Glucides</th>
          </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['recette'] . "</td>";
        echo "<td>" . $row['calories'] . "</td>";
        echo "<td>" . $row['lipides'] . "</td>";
        echo "<td>" . $row['glucides'] . "</td>";
        echo "</tr>";
    }
    echo '</table>';
} else {
    echo "<p>Aucun suivi nutritionnel trouvé pour cet utilisateur.</p>";
}
?>

</body>
</html>

<?php
mysqli_close($conn);
?>
