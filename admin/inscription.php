<!DOCTYPE html>
<html lang="fr">
<head>

    <title>Inscription Admin</title>
 
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
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 40px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-left: 30%;
    margin-top: 20px;
    width: 40%;
    background-color: green;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 2px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25%;
}


    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <form action="inscription.php" method="post">
    <h3>Admin inscription</h3>
    <label for="nom">Nom</label>
    <input type="text" name="nom" placeholder="Nom" id="nom" required>
    
    <label for="email">Email</label>
    <input type="text" name="email" placeholder="Email" id="email" required>
    
    <label for="mot_de_passe">Mot de passe</label>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" id="mot_de_passe" required>

    <button type="submit" name="inscription">S'inscrire</button>
    
    <div class="social">
        <div class="fb"><a href="connexion_admin.php">J'ai un compte</a></div>
    </div>
</form>


<?php
require_once '../db.php';

function secure_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['inscription'])) {
    $nom = secure_input($_POST['nom']);
    $classe_admin = secure_input($_POST['classe_admin']);
    $code_admin = secure_input($_POST['code_admin']);
    $email = secure_input($_POST['email']);
    $mot_de_passe = secure_input($_POST['mot_de_passe']);

    $check_email_query = "SELECT * FROM admins WHERE email_admin='$email'";
    $result = $conn->query($check_email_query);
    if($result->num_rows > 0) {
        echo ("<script> alert('Cet email est déjà utilisé. Veuillez choisir un autre'</script>");
    } else {
        $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO admins (nom, classe_admin, code_admin, email_admin, mot_de_passe)
                         VALUES ('$nom', '$classe_admin', '$code_admin', '$email', '$hashed_password')";
        if($conn->query($insert_query) === TRUE) {
            header("location: wel.php");
        } else {
            echo "<script>alert('Erro lors de l'inscription')</script>; " . $conn->error;
        }
    }
}

$conn->close();
?>

   
</body>
</html>
