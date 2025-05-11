<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['pseudo'])) {
    echo "Veuillez vous connecter pour accéder à cette page.";
    exit;
}

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "nutrition");

if (!$conn) {
    echo "Échec de la connexion à la base de données.";
    exit;
}

// Récupérer toutes les recettes
$sql_recettes = "SELECT * FROM recettes";
$result_recettes = mysqli_query($conn, $sql_recettes);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une Recette</title>
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            margin: 30px 0;
        }

        table {
            width: 80%;
            max-width: 900px;
            margin: 20px 0;
            border-collapse: collapse;
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

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 80%;
            max-width: 400px;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #444;
        }

        input, button {
            padding: 12px;
            border: 1px solid #444;
            border-radius: 6px;
            background-color: #292929;
            color: #fff;
            font-size: 16px;
        }

        button {
            background-color: #e53935;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #c62828;
            transform: scale(1.05);
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

    <h2>Choisir une Recette</h2>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Calories</th>
                <th>Lipides</th>
                <th>Glucides</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Utilisation de `foreach` directement sur le résultat de la requête
            foreach ($result_recettes as $row) {
            ?>
                <tr>
                    <td><?php echo $row['nom']; ?></td>
                    <td><?php echo $row['calories']; ?></td>
                    <td><?php echo $row['lipides']; ?></td>
                    <td><?php echo $row['glucides']; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <form action="choisir-recettefinal.php" method="POST">
        <label for="recette">Entrez le nom de la recette :</label>
        <input type="text" name="recette" id="recette" required placeholder="Nom de la recette">
        <button type="submit">Ajouter au suivi nutritionnel</button>
    </form>

    <footer>
        © 2025 | Khalil Chaabani. Tous droits réservés.
    </footer>

</body>
</html>

<?php
// Fermeture de la connexion
mysqli_close($conn);
?>
