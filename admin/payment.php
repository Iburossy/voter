<?php
// Inclure le fichier de configuration de la base de données
include_once 'payment.php';

// Traitement pour confirmer un paiement valide
if(isset($_POST['confirmer_paiement'])) {
    $idPaiement = $_POST['id_paiement'];
    $idTransaction = $_POST['id_transaction'];
    $montant = $_POST['montant'];

    // Insérer le paiement confirmé dans la table paiements_valides
    $sqlInsert = "INSERT INTO paiements_valides (id_paiement, id_utilisateur, id_transaction, montant, date_validation) 
                  VALUES ('$idPaiement', (SELECT id_utilisateur FROM transactions WHERE id_transaction = '$idTransaction'), '$idTransaction', '$montant', CURDATE())";
    if(mysqli_query($conn, $sqlInsert)) {
        // Mettre à jour le statut de la transaction dans la table transactions
        $sqlUpdate = "UPDATE transactions SET statut_validation = 'confirmé' WHERE id_transaction = '$idTransaction'";
        if(mysqli_query($conn, $sqlUpdate)) {
            echo "<script>alert('Paiement confirmé avec succès.');</script>";
        } else {
            echo "<script>alert('Erreur lors de la mise à jour du statut de la transaction. Veuillez réessayer.');</script>";
        }
    } else {
        echo "<script>alert('Erreur lors de la confirmation du paiement. Veuillez réessayer.');</script>";
    }
}

// Requête SQL pour récupérer tous les paiements en attente de validation
$sqlPaiements = "SELECT * FROM transactions WHERE statut_validation = 'en attente'";
$resultPaiements = mysqli_query($conn, $sqlPaiements);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Paiements - IAM_VOTE</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Gestion des Paiements - IAM_VOTE</h2>
    
    <!-- Liste des paiements en attente -->
    <h4>Paiements en Attente de Validation</h4>
    <table class="table">
      <thead>
        <tr>
          <th>ID Transaction</th>
          <th>ID Utilisateur</th>
          <th>Montant</th>
          <th>Méthode de Paiement</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Afficher les données des paiements en attente dans le tableau
        while($row = mysqli_fetch_assoc($resultPaiements)) {
            echo "<tr>";
            echo "<td>".$row['id_transaction']."</td>";
            echo "<td>".$row['id_utilisateur']."</td>";
            echo "<td>".$row['montant']."</td>";
            echo "<td>".$row['methode_paiement']."</td>";
            echo "<td>
                    <form method='post' action=''>
                      <input type='hidden' name='id_paiement' value='".$row['id_transaction']."'>
                      <input type='hidden' name='id_transaction' value='".$row['id_transaction']."'>
                      <input type='hidden' name='montant' value='".$row['montant']."'>
                      <button type='submit' class='btn btn-success btn-sm' name='confirmer_paiement'>Confirmer Paiement</button>
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
