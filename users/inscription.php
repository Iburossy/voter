<!DOCTYPE html>
<html lang="fr">
<head>

    <title>Inscription</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 520px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 10px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 30px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 3px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-left: 30%;
    margin-top: 18px;
    width: 40%;
    background-color: green;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.fb{
  /* margin-left: 25%; */
  text-align: center;
}


    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <form action="inscription.php" method="post">
    <h3>Inscription</h3>
    <label for="username">Nom</label>
    <input type="text" name="nom" placeholder="Nom" id="username" required>

    <label for="code_etudiant">Code étudiant</label>
    <input type="text" name="code_etudiant" placeholder="Code étudiant" id="code_etudiant" required>

    <label for="classe_utilisateur">Classe</label>
    <input type="text" name="classe_utilisateur" placeholder="Votre classe" id="classe_utilisateur" required>

    <label for="email">Email</label>
    <input type="text" name="email" placeholder="Email" id="email" required>

    <label for="passwords">Mot de passe</label>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" id="passwords" required>

    <button type="submit" name="inscription">S'inscrire</button>

    <div class="fb"><a href="connexion.php">J'ai un compte</a></div>
</form>

<?php
require_once '../db.php';

session_start(); // Démarrer la session

if(isset($_POST['inscription'])) {
    $nom = $_POST['nom'];
    $code_etudiant = $_POST['code_etudiant'];
    $classe_utilisateur = $_POST['classe_utilisateur'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $check_email_query = "SELECT * FROM utilisateurs WHERE email_utilisateur=?";
    $stmt = $conn->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        echo "<script>alert('Cet email est déjà utilisé. Veuillez choisir un autre');</script>";
    } else {
        $date_inscription = date("Y-m-d");
        $statut = 'inactif';
        $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO utilisateurs (nom, code_etudiant, classe_utilisateur, email_utilisateur, mot_de_passe, date_inscription, statut)
                         VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sssssss", $nom, $code_etudiant, $classe_utilisateur, $email, $hashed_password, $date_inscription, $statut);
        $stmt->execute();

        // Inscription réussie, définissez les données de session
        $_SESSION['id_utilisateur'] = $stmt->insert_id;
        $_SESSION['nom_utilisateur'] = $nom;

        header("location: vote.php"); // Rediriger vers la page
        exit(); // Arrêter l'exécution du script après la redirection
    }
}

$conn->close();
?>
</body>
</html>