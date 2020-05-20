<?php

// On à récupéré les images, maintenant, on va les afficher

// Connection BDD
try {
  $db = new PDO("mysql:host=localhost;dbname=photos", "root", "root");

} catch(Execption $e) {

  die($e->getMessage());

}

// Appelle du résultat dans la BDD et affichage

$recuperation = $db->Query("SELECT chemin FROM photos ORDER BY ID DESC LIMIT 0,30");

//On fetch tout ça

while($resultat = $recuperation->fetch()) {

  echo "<img src='".$resultat['chemin']."' class='petit'>";

}

$resultat->closeCursor(); // on ferme




?>
