<?php
session_start();

$pseudo = $_SESSION['pseudo'];

$conn = mysqli_connect("localhost", "root", "", "nutrition");

$sql_suivi = "SELECT * FROM suivi_nutritionnel WHERE id_utilisateur = '$pseudo'";
$result = mysqli_query($conn, $sql_suivi);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir Suivi Nutritionnel</title>
</head>
<body>

<h2>Mon Suivi Nutritionnel</h2>

<table border="1">
    <tr>
        <th>Date</th>
        <th>Calories</th>
        <th>Lipides</th>
        <th>Glucides</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['calories'] . "</td>";
        echo "<td>" . $row['lipides'] . "</td>";
        echo "<td>" . $row['glucides'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>

<?php
mysqli_close($conn);
?>
