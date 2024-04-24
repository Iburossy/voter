<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil Admin - IAM_VOTE</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body{
        background-color: burlywood;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2>Bienvenue, Admin</h2>
    <p>Choisissez une fonctionnalité à partir des options ci-dessous :</p>

    <!-- Boutons pour les fonctionnalités -->
    <div class="row">
      <div class="col-md-4">
        <a href="tab.php" class="btn btn-primary btn-lg btn-block mb-3">Vue</a>
      </div>
      <div class="col-md-4">
        <a href="candidat.php" class="btn btn-primary btn-lg btn-block mb-3">Gestion des Candidats</a>
      </div>
      <div class="col-md-4">
        <a href="usergest.php" class="btn btn-primary btn-lg btn-block mb-3">Gestion des Utilisateurs</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <a href="gestion_paiements.php" class="btn btn-primary btn-lg btn-block mb-3">Gestion des Paiements</a>
      </div>
      <div class="col-md-4">
        <a href="moderation_contenu.php" class="btn btn-primary btn-lg btn-block mb-3">Modération du Contenu</a>
      </div>
      <div class="col-md-4">
        <a href="statistiques_rapports.php" class="btn btn-primary btn-lg btn-block mb-3">Statistiques et Rapports</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <a href="parametres_application.php" class="btn btn-primary btn-lg btn-block mb-3">Paramètres de l'Application</a>
      </div>
    </div>
  </div>

  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
