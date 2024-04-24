<?php
// Inclure le fichier de configuration de la base de données
include_once '../db.php';

// Traitement pour bloquer ou débloquer un utilisateur
if(isset($_POST['bloquer_utilisateur']) || isset($_POST['debloquer_utilisateur'])) {
    $id = $_POST['id'];
    $statut = isset($_POST['bloquer_utilisateur']) ? 'inactif' : 'actif';

    // Mettre à jour le statut de l'utilisateur dans la base de données
    $sqlUpdate = "UPDATE utilisateurs SET statut = '$statut' WHERE id_utilisateur = $id";
    if(mysqli_query($conn, $sqlUpdate)) {
        echo "<script>alert('Statut de l\'utilisateur mis à jour avec succès.');</script>";
    } else {
        echo "<script>alert('Erreur lors de la mise à jour du statut de l\'utilisateur. Veuillez réessayer.');</script>";
    }
}

// Traitement pour supprimer un utilisateur
if(isset($_POST['supprimer_utilisateur'])) {
    $id = $_POST['id'];

    // Supprimer l'utilisateur de la base de données
    $sqlDelete = "DELETE FROM utilisateurs WHERE id_utilisateur = $id";
    if(mysqli_query($conn, $sqlDelete)) {
        echo "<script>alert('Utilisateur supprimé avec succès.');</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression de l\'utilisateur. Veuillez réessayer.');</script>";
    }
}

// Requête SQL pour récupérer tous les utilisateurs de la base de données
$sqlUtilisateurs = "SELECT * FROM utilisateurs";
$resultUtilisateurs = mysqli_query($conn, $sqlUtilisateurs);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Utilisateurs - IAM_VOTE</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body{
        background-color: burlywood;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2>Gestion des Utilisateurs - IAM_VOTE</h2>
    
    <!-- Liste des utilisateurs -->
    <h4>Liste des Utilisateurs</h4>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Code Étudiant</th>
          <th>ECOLE</th>
          <th>Email</th>
          <th>Date d'Inscription</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Afficher les données des utilisateurs dans le tableau
        while($row = mysqli_fetch_assoc($resultUtilisateurs)) {
            echo "<tr>";
            echo "<td>".$row['id_utilisateur']."</td>";
            echo "<td>".$row['nom']."</td>";
            echo "<td>".$row['code_etudiant']."</td>";
            echo "<td>".$row['classe_utilisateur']."</td>";
            echo "<td>".$row['email_utilisateur']."</td>";
            echo "<td>".$row['date_inscription']."</td>";
            echo "<td>".$row['statut']."</td>";
            echo "<td>
                    <form method='post' action=''>
                      <input type='hidden' name='id' value='".$row['id_utilisateur']."'>";
            if($row['statut'] == 'actif') {
                echo "<button type='submit' class='btn btn-warning btn-sm' name='bloquer_utilisateur'>Bloquer</button>";
            } else {
                echo "<button type='submit' class='btn btn-success btn-sm' name='debloquer_utilisateur'>Débloquer</button>";
            }
            echo "  <button type='submit' class='btn btn-danger btn-sm' name='supprimer_utilisateur'>Supprimer</button>
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
