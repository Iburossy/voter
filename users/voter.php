<?php
require_once '../db.php';
// Vérifiez si le formulaire de vote a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si l'ID du candidat est défini dans la requête POST
    if (isset($_POST['id_candidat'])) {
        // Récupérez l'ID du candidat à partir de la requête POST
        $id_candidat = $_POST['id_candidat'];


        // Récupérez l'ID de l'utilisateur à partir d'une session ou d'un autre mécanisme d'authentification
        // Dans cet exemple, supposons que l'ID de l'utilisateur soit stocké dans une session avec le nom 'user_id'
        session_start();
        $id_utilisateur = $_SESSION['user_id']; // Assurez-vous d'avoir initialisé la session auparavant

        // Date du vote
        $date_vote = date('Y-m-d');

        // Vérifiez si l'utilisateur a déjà voté pour ce candidat
        $sql_check_vote = "SELECT * FROM votes WHERE id_utilisateur = $id_utilisateur AND id_candidat = $id_candidat";
        $result_check_vote = mysqli_query($conn, $sql_check_vote);

        if (mysqli_num_rows($result_check_vote) > 0) {
            // L'utilisateur a déjà voté pour ce candidat
            echo "Vous avez déjà voté pour ce candidat.";
        } else {
            // Insertion du vote dans la base de données
            $sql_insert_vote = "INSERT INTO votes (id_utilisateur, id_candidat, date_vote, nombre_vote_obtenus) VALUES ($id_utilisateur, $id_candidat, '$date_vote', 1)";
            if (mysqli_query($conn, $sql_insert_vote)) {
                echo "Votre vote a été enregistré avec succès pour ce candidat.";
            } else {
                echo "Erreur lors de l'enregistrement de votre vote: " . mysqli_error($conn);
            }
        }

        // Fermez la connexion à la base de données
        mysqli_close($conn);
    } else {
        echo "ID de candidat non spécifié.";
    }
} else {
    echo "Accès non autorisé.";
}
?>
