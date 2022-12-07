<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('config.php');
if (isset($_REQUEST['customer_id'], $_REQUEST['username'], $_REQUEST['password'])){
  // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn, $username); 
  // récupérer l'customer_id et supprimer les antislashes ajoutés par le formulaire
  $customer_id = stripslashes($_REQUEST['customer_id']);
  $customer_id = mysqli_real_escape_string($conn, $customer_id);
  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  //requéte SQL + mot de passe crypté
    $query = "INSERT into `logins` (username, customer_id, password)
              VALUES ('$username', '$customer_id', '".hash('sha256', $password)."')";
  // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
       </div>";
    }
}else{
?>
<form class="box" action="" method="post">
  <h1 class="box-logo box-title"><a href="https://waytolearnx.com/">WayToLearnX.com</a></h1>
    <h1 class="box-title">S'inscrire</h1>
  <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
    <input type="text" class="box-input" name="customer_id" placeholder="customer_ids" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
</form>
<?php } ?>
</body>
</html>