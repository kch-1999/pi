<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'nutrition';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}


if (isset($_POST['username'])) {
    $username = $_POST['username']; 
    $sqlDelete = "DELETE FROM utilisateur WHERE pseudo = '$username'";
    $conn->query($sqlDelete);

    
    header("Location: sup-compt-utu-ad.php");
    exit;
}


$sql = "SELECT id_utilisateur, pseudo, email FROM utilisateur ORDER BY id_utilisateur ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer le Compte</title>
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            width: 100%;
            background-color: #1f1f1f;
            padding: 10px 20px;
            display: flex;
            justify-content: flex-start;
        }

        .nav-button {
            background-color: #292929;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            border: 1px solid #444;
            transition: background-color 0.3s, transform 0.3s;
        }

        .nav-button:hover {
            background-color: #333;
            transform: scale(1.05);
        }

        h2 {
            margin: 30px 0 20px;
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

        input[type="text"] {
            padding: 12px;
            border: 1px solid #444;
            border-radius: 6px;
            background-color: #292929;
            color: #fff;
            font-size: 16px;
        }

        button {
            padding: 12px;
            background-color: #000;
            color: #fff;
            border: 1px solid #555;
            border-radius: 6px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s, border-color 0.3s;
        }

        button:hover {
            background-color: #111;
            border-color: #888;
            transform: scale(1.05);
        }

        table {
            width: 80%;
            max-width: 800px;
            border-collapse: collapse;
            margin-top: 40px;
            margin-bottom: 50px;
            color: #f1f1f1;
            background-color: #1e1e1e;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #444;
            text-align: left;
        }

        th {
            background-color: #292929;
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

<header>
    <a href="admin.php" class="nav-button">Retour</a>
</header>

<h2>Supprimer Compte utulisateur </h2>

<form action="sup-compt-utu-ad.php" method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <button type="submit">Supprimer</button>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Pseudo</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['id_utilisateur'] . "</td>";
                echo "<td>" . $row['pseudo'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Aucun utilisateur trouvé</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>

<footer>
    © 2025 | Khalil Chaabani. Tous droits réservés.
</footer>

</body>
</html>
