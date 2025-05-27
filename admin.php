<?php

$conn = mysqli_connect("localhost", "root", "", "nutrition");

if (!$conn) {
    echo "Échec de la connexion à la base de données.";
    exit;
}


$pseudo = $_POST['pseudo'];
$mot_de_passe = $_POST['mot_de_passe'];


$query = "SELECT * FROM admin WHERE pseudo = '$pseudo'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
   
    if ($row['mot_de_passe'] == $mot_de_passe) {
        
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin Dashboard</title>
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body {
                    background-color: #121212;
                    color: #f1f1f1;
                    font-family: 'Poppins', sans-serif;
                    min-height: 100vh;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }
                header {
                    background-color: #1e1e1e;
                    width: 100%;
                    padding: 20px;
                    text-align: center;
                }
                .nav-button {
                    text-decoration: none;
                    color: #f1f1f1;
                    font-weight: bold;
                    padding: 12px 25px;
                    background-color: #333;
                    border-radius: 5px;
                }
                .nav-button:hover {
                    background-color: #555;
                    transform: scale(1.05);
                }
                main {
                    flex: 1;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 100%;
                    padding: 20px;
                }
                .Container_Admin {
                    background-color: #1e1e1e;
                    padding: 30px;
                    border-radius: 8px;
                    width: 100%;
                    max-width: 600px;
                }
                h4, h5 {
                    text-align: center;
                    margin-bottom: 10px;
                }
                .button-container {
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                    margin-top: 20px;
                }
                .button-container button {
                    width: 100%;
                    padding: 12px;
                    background-color: #333;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                }
                .button-container button:hover {
                    background-color: #555;
                    transform: scale(1.05);
                }
                footer {
                    background-color: #1e1e1e;
                    color: #aaaaaa;
                    padding: 20px;
                    width: 100%;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <header>
                <nav>
                    <a href="index.html" class="nav-button">Home</a>
                </nav>
            </header>

            <main>
                <div class="Container_Admin">
                    <h4>interface admin </h4>
                    <h5>Choisissez l'option à gérer</h5>
                    <div class="button-container">
                        <a href="ajouterreccete.html"><button type="button">Ajouter une recette</button></a>
                        <a href="sup-recette.php"><button type="button">Supprimer une recette</button></a>
                        <a href="sup-compt-utu-ad.php"><button type="button">supprimer le profil utilisateur</button></a>
                    </div>
                </div>
            </main>

            <footer>
                <p>© 2025 Copyright by Khalil Chaabani. All rights reserved.</p>
            </footer>
        </body>
        </html>
        <?php
    } else {
        echo "Mot de passe incorrect.";
    }
} else {
    echo "Pseudo introuvable.";
}

mysqli_close($conn);
?>
