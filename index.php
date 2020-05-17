<?php

// Projet hébergeur d'image
// La personne envoie une image et on l'affiche après

// img src="uploads/$files..."
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

  if($_FILES['image']['size'] <= 2000000){

    $informations = pathinfo($_FILES['image']['name']);

    $extensionFichier = $informations['extension'];

    $extensionAutorisee = array('png','jpg','gif','JPEG');

    if(in_array($extensionFichier, $extensionAutorisee)) {

      // Si tout est bon, alors on envoie
      // Ne pas oubliez de concatener le point pour l'ajout de l'extension
      $addresse = 'uploads/'.time().rand().'.'.$extensionFichier;

      move_uploaded_file($_FILES['image']['tmp_name'], $addresse);

     echo "L'envoie du fichier ".$addresse." est bon.";
    }
  }
}




  echo '<form action="index.php" method="POST" enctype="multipart/form-data">

          <h1> Bienvenue dans votre hébergeur d"images </h1>

          <input type="file" name="image" required>

          <br>

          <input type="submit" value="Envoyer">

          </form>';


   if($_FILES['image']['error'] == 0) {
    echo '
          <img src="'.$addresse.'">
          <input type="text" value="http://localhost/'.$addresse.'">
        '; // Ne pas oubliez de concaténer avant et après
          // On peut également intégrer l'adresse du fichier

          // Next => Modifation CSS de l'image pour qu'elle soit toutes de la même taille / Connection BDD pour afficher toutes les images du même user
  }




 ?>
