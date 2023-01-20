<?php
//lorsqu'on se déconnecte on détruit la session pour pouvoir réinitialiser toutes les variables de session

  // Initialiser la session
  session_start();
  
  // Détruire la session.
  if(session_destroy())
  {
    // Redirection vers la page de connexion
    header("Location: accueil");
  }
?>