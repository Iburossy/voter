<?php
// Inclure le fichier de configuration de la base de données
include_once '../db.php';

// Traitement pour ajouter un nouveau candidat
if(isset($_POST['ajouter_candidat'])) {
    $nom = $_POST['nom'];
    $code_candidat = $_POST['code_candidat'];
    $descriptions = $_POST['descriptions'];
    // $departement = $_POST['departement'];
    $classe = $_POST['classe'];

    // Vérifier si le nom et le code du candidat n'existent pas déjà dans la base de données
    $sqlCheck = "SELECT * FROM candidats WHERE nom_candidat = '$nom' OR code_candidat = '$code_candidat'";
    $resultCheck = mysqli_query($conn, $sqlCheck);

    if(mysqli_num_rows($resultCheck) > 0) {
        // Le nom ou le code du candidat existe déjà
        echo "<script>alert('Le nom ou le code du candidat existe déjà.');</script>";
    } else {
        // Insertion du nouveau candidat dans la base de données
        $sqlInsert = "INSERT INTO candidats (nom_candidat, code_candidat, descriptions, classe_candidat) 
                      VALUES ('$nom', '$code_candidat', '$descriptions', '$classe')";
        if(mysqli_query($conn, $sqlInsert)) {
            echo "<script>alert('Nouveau candidat ajouté avec succès.');</script>";
        } else {
            echo "<script>alert('Erreur lors de l'ajout du candidat. Veuillez réessayer.');</script>";
        }
    }
}

// Traitement pour supprimer un candidat
if(isset($_POST['supprimer_candidat'])) {
    $id = $_POST['id'];

    // Supprimer le candidat de la base de données
    $sqlDelete = "DELETE FROM candidats WHERE id_candidat = $id";
    if(mysqli_query($conn, $sqlDelete)) {
        echo "<script>alert('Candidat supprimé avec succès.');</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression du candidat. Veuillez réessayer.');</script>";
    }
}

// Requête SQL pour récupérer tous les candidats de la base de données
$sqlCandidats = "SELECT * FROM candidats";
$resultCandidats = mysqli_query($conn, $sqlCandidats);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Candidats - IAM_VOTE</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Gestion des Candidats - IAM_VOTE</h2>
    <!-- Formulaire pour ajouter un nouveau candidat -->
    <div class="card my-4">
      <h5 class="card-header">Ajouter un Nouveau Candidat</h5>
      <div class="card-body">
        <form method="post" action="">

          <div class="form-group">
            <label for="nom">Nom du Candidat:</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
          </div>
          <div class="form-group">
            <label for="code_candidat">Code du Candidat:</label>
            <input type="text" class="form-control" id="code_candidat" name="code_candidat" required>
          </div>

          <div class="form-group">
            <label for="descriptions">Mot du candidat:</label>
            <input type="text" class="form-control" id="descriptions" name="descriptions" required>
          </div>

          <!-- <div class="form-group">
            <label for="departement">Département du Candidat:</label>
            <input type="text" class="form-control" id="departement" name="departement" required>
          </div> -->
          <div class="form-group">
            <label for="classe">Classe du Candidat:</label>
            <input type="text" class="form-control" id="classe" name="classe" required>
          </div>
          <button type="submit" class="btn btn-primary" name="ajouter_candidat">Ajouter Candidat</button>
        </form>
      </div>
    </div>
    
    <!-- Liste des candidats -->
    <h4>Liste des Candidats</h4>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Code</th>
          <th>Phrase</th>
          <th>Classe</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Afficher les données des candidats dans le tableau
        while($row = mysqli_fetch_assoc($resultCandidats)) {
            echo "<tr>";
            echo "<td>".$row['id_candidat']."</td>";
            echo "<td>".$row['nom_candidat']."</td>";
            echo "<td>".$row['code_candidat']."</td>";
            echo "<td>".$row['descriptions']."</td>";
            echo "<td>".$row['classe_candidat']."</td>";
            echo "<td>
                    <form method='post' action=''>
                      <input type='hidden' name='id' value='".$row['id_candidat']."'>
                      <button type='submit' class='btn btn-danger btn-sm' name='supprimer_candidat'>Supprimer</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
