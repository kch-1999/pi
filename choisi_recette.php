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

// Traitement du formulaire (si soumis)
if (isset($_POST['recette'])) {
    $pseudo = $_SESSION['pseudo'];      // Sans échappement
    $recette = $_POST['recette'];       // Sans échappement

    $sql_user = "SELECT id_utilisateur FROM utilisateur WHERE pseudo = '$pseudo'";
    $result_user = mysqli_query($conn, $sql_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $user_row = mysqli_fetch_assoc($result_user);
        $id_utilisateur = $user_row['id_utilisateur'];

        $sql_recette = "SELECT * FROM recettes WHERE nom = '$recette'";
        $result_recette = mysqli_query($conn, $sql_recette);

        if ($result_recette && mysqli_num_rows($result_recette) > 0) {
            $recette_row = mysqli_fetch_assoc($result_recette);

            $calories = $recette_row['calories'];
            $lipides = $recette_row['lipides'];
            $glucides = $recette_row['glucides'];
            $date = date("Y-m-d");

            $sql_insert = "INSERT INTO suivi_nutritionnel (id_utilisateur, date, recette, calories, lipides, glucides) 
                           VALUES ('$id_utilisateur', '$date', '$recette', '$calories', '$lipides', '$glucides')";

            if (mysqli_query($conn, $sql_insert)) {
                echo "<p class='message'>Recette ajoutée au suivi nutritionnel avec succès !</p>";
            } else {
                echo "<p class='message erreur'>Erreur lors de l'ajout au suivi nutritionnel : " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p class='message erreur'>Recette non trouvée.</p>";
        }
    } else {
        echo "<p class='message erreur'>Utilisateur non trouvé.</p>";
    }
}


$sql_recettes = "SELECT * FROM recettes";
$result_recettes = mysqli_query($conn, $sql_recettes);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
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
            background-color: #555;
            transition: background-color 0.3s, transform 0.3s;
        }
        button:hover {
            background-color: #777;
            transform: scale(1.05);
        }
        footer {
            margin-top: auto;
            padding: 20px;
            font-size: 12px;
            color: #aaa;
        }
        .message {
            margin: 15px 0;
            font-weight: bold;
            color: #4caf50;
        }
        .erreur {
            color: #f44336;
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

<form action="choisi_recette.php" method="POST">
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
mysqli_close($conn);
?>
