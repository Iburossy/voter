<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des candidats</title>
    <!-- Ajout des fichiers CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-video {
        
            width: 100%;
            height: 220px;
            object-fit: cover;
            object-position: center;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            
            

        }

        .row{
            margin-top: 4%;
            margin-bottom: 4%;
            margin-left: 4%;
            margin-right: 4%;

        }

        body{
            background-image: url(../images/bridge-53769_1920.jpg);
            padding-top: 3%;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require_once '../db.php';

        $sql = "SELECT * FROM candidats";
        $result = mysqli_query($conn, $sql);

        // Vérifiez si des candidats sont disponibles
        if (mysqli_num_rows($result) > 0) {
            // Affichez chaque candidat dans une carte Bootstrap
            echo "<div class='row'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-md-4'>";
                echo "<div class='card mb-4'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row['nom_candidat'] . "</h5>";
                // echo "<p class='card-text'><strong>Code:</strong> " . $row['code_candidat'] . "</p>";
                // echo "<p class='card-text'><strong>Departement:</strong> " . $row['departement_candidat'] . "</p>";
                echo "<p class='card-text'><strong>Classe:</strong> " . $row['classe_candidat'] . "</p>";
                echo "<p class='card-text'><strong>Citation:</strong> <br> " . $row['descriptions'] . "</p>";
                // Ajoutez une vidéo ou une image du candidat si nécessaire
                echo ('<iframe src="../images/tourner la page.mp4" frameborder="0" class="card-video" autoplay="false"></iframe>');
                // Ajoutez un bouton de vote pour chaque candidat
                echo "<form action='voter.php' method='post'>";
                echo "<input type='hidden' name='id_candidat' value='" . $row['id_candidat'] . "'>";
                echo "<button type='submit' class='btn btn-primary btn-block'>Votez pour ce candidat</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<div class='alert alert-warning'>Aucun candidat disponible.</div>";
        }
        ?>
    </div>
    <?php
include 'footer.html';
  ?>
    <!-- Ajout des fichiers JavaScript de Bootstrap -->
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> -->
    <script src="js/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    
</body>
</html>
