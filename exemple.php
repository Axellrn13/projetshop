<?php
require('config.php');
if(isset($_POST['name'])){
    $name = stripslashes($_POST['name']);
    $name = mysqli_real_escape_string($conn, $name); 
    $query = "INSERT into `users` (pseudo) VALUES ('$name')";
    $res = mysqli_query($conn, $query);
    if($res){
        echo "<div class='sucess'>
              <h3>Vous êtes inscrit avec succès.</h3>
              <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
        </div>";
     }

}
else {
?>
<form method="post" action="exemple.php">
        Pseudo (a-z0-9) : <input type="text" name="name">
        <br />
        <input type="submit" value="S'inscrire">
    </form>
    <?php
}
?>