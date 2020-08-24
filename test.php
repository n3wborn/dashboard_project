<?php
require_once 'php/database.php';
require_once "php/functions.php";

if(!empty($_FILES)){
    $pic_name = $_FILES['picture']['name'];
    $pic_extension = strrchr($pic_name, ".");

    $pic_tmp_name = $_FILES['picture']['tmp_name'];
    $pic_dest = 'medias/'.$pic_name;


    $extension_aut = array('.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG');
//Si extension bonne, on continue :
    if (in_array($pic_extension, $extension_aut)){
        //On déplace le fichier dans le fichier destination
        if(move_uploaded_file($pic_tmp_name, $pic_dest)){
            //On stocke dans ma bdd
            $sql = $dbh->prepare('INSERT INTO test(name, file_url) VALUES (?,?)');
            $sql->execute(array($pic_name, $pic_dest));
            echo 'Fichier envoyé avec succès';
        }else{
            echo 'Une erreur est survenue lors de lenvoi du fichier';
        }
    }else{
        echo 'Seuls les fichiers .jpg, .jpeg et .png sont autorisés';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h3>Envoi d'une image</h3>
      <form enctype="multipart/form-data" action="#" method="POST">
      <input type="file" name="picture" /> 
         <input type="submit" value="Envoyer" />
      </form>
</body>
</html>