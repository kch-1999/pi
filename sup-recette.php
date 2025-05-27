<?php

$conn = mysqli_connect("localhost", "root", "", "nutrition");

if (!$conn) {
    echo "Échec de la connexion à la base de données.";
    exit;
}


$sql = "SELECT * FROM recettes";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Recettes</title>
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease-in-out;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
            border: 1px solid #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #1e1e1e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #2c2c2c;
        }

        tr:hover {
            background-color: #555;
        }

        .form-container {
            margin-top: 30px;
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        .form-container input {
            padding: 12px;
            margin: 10px 0;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #333;
            color: white;
        }

        .form-container button {
            padding: 12px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .form-container button:hover {
            background-color: #d32f2f;
            transform: scale(1.05);
        }

    </style>
</head>
<body>

   
    <h2>Liste des Recettes</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Ingrédients</th>
            <th>Calories</th>
            <th>Lipides</th>
            <th>Glucides</th>
        </tr>

        <?php
        
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['ingredients'] . "</td>";
            echo "<td>" . $row['calories'] . "</td>";
            echo "<td>" . $row['lipides'] . "</td>";
            echo "<td>" . $row['glucides'] . "</td>";
            echo "</tr>";
        }
        ?>

    </table>

   
    <div class="form-container">
        <h4>Supprimer une Recette</h4>
        <form method="POST" action="sup-recette2.php">
            <label for="nom">Nom de la recette à supprimer :</label>
            <input type="text" id="nom" name="nom" required>
            <button type="submit" name="delete">Supprimer</button>
        </form>
    </div>

</body>
</html>

<?php

mysqli_close($conn);
?>
