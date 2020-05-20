<?php


// Projet hébergeur d'image
// La personne envoie une image et on l'affiche après

// img src="uploads/$files..."

// ici on vérifie que l'envoie n'a pas eu d'erreur
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

// On vérifie la taille du fichier
  if($_FILES['image']['size'] <= 2000000){

// On récupère les infos dans un arrya (notament l'extension)
    $informations = pathinfo($_FILES['image']['name']);

// qu'on enregistre dans une var
    $extensionFichier = $informations['extension'];

// On créer une variable comprenant tous les extensions acceptées
    $extensionAutorisee = array('png','jpg','gif','JPEG','pdf','svg');

// On vérifie si dans l'array d'extension autorisé se trouve l'exention du fichier
    if(in_array($extensionFichier, $extensionAutorisee)) {

      // Si tout est bon, alors on envoie
      // Ne pas oubliez de concatener le point pour l'ajout de l'extension
      $addresse = 'uploads/'.time().rand().'.'.$extensionFichier;

      // avec cette fonction on bouge le fichier avec son nom temporaire à l'adresse de fin (avec son nom de fin)
      move_uploaded_file($_FILES['image']['tmp_name'], $addresse);

     echo "L'envoie du fichier ".$addresse." est bon.";

     // Connection et envoie DB
     try {
       $db = new PDO("mysql:host=localhost;dbname=photos", "root", "root");
     } catch(Exception $e) {
       die($e->getMessage());
     }
     // Requete de préparation pour l'envoie en DB
     $envoie = $db->prepare("INSERT INTO photos(chemin) VALUES (?)");
     // ENvoie une fois les infos mises 
     $envoie->execute(array($addresse));

     echo "L'envoie dans la base de données c'est bien effectué";



    }
  }
}


?>
