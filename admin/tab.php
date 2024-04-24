<?php
// Inclure le fichier de configuration de la base de données
include_once '../db.php';

// Requêtes SQL pour récupérer les données du tableau de bord
// Exemple : nombre total de candidats, nombre d'utilisateurs enregistrés, etc.
$sqlCandidats = "SELECT COUNT(*) AS totalCandidats FROM candidats";
$resultCandidats = mysqli_query($conn, $sqlCandidats);
$rowCandidats = mysqli_fetch_assoc($resultCandidats);

$sqlUtilisateurs = "SELECT COUNT(*) AS totalUtilisateurs FROM utilisateurs";
$resultUtilisateurs = mysqli_query($conn, $sqlUtilisateurs);
$rowUtilisateurs = mysqli_fetch_assoc($resultUtilisateurs);

$sqlPaiements = "SELECT COUNT(*) AS totalPaiements FROM paiements_valides";
$resultPaiements = mysqli_query($conn, $sqlPaiements);
$rowPaiements = mysqli_fetch_assoc($resultPaiements);

// Calculer d'autres statistiques si nécessaire...

// Fermer la connexion à la base de données
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de Bord - IAM_VOTE</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Tableau de Bord - IAM_VOTE</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nombre total de candidats</h5>
            <p class="card-text"><?php echo $rowCandidats['totalCandidats']; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nombre total d'utilisateurs enregistrés</h5>
            <p class="card-text"><?php echo $rowUtilisateurs['totalUtilisateurs']; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nombre total de paiements reçus</h5>
            <p class="card-text"><?php echo $rowPaiements['totalPaiements']; ?></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Ajoutez d'autres statistiques si nécessaire -->
  </div>

  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
