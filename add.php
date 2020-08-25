<?php
require_once 'php/database.php';
require_once "php/functions.php";

if (!connected()) {
	header('Location: ./login.php');
}


$id ='';
$location = '';
$name_product = '';
$ref_product = '';
$categories = '';
$purchase_date = '';
$garanty_date = '';
$price = '';
$advice = '';
$picture = '';
$manual = '';
$error = false;
// $data = array();


if ( count($_POST) > 0) {

    // location
    
    if (strlen(trim($_POST['location']))!== 0){
        $location = trim($_POST['location']);
        $sql= "SELECT id FROM sites WHERE name =:location" ;
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':location', $location, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll();
        if(isset($result[0])){
            $locId = $result[0]["id"];
        }else{
            $sql2 = "INSERT INTO `sites` (`name`) VALUES (:location)";
            $sth = $dbh->prepare($sql2);
            $sth->bindParam(':location', $location, PDO::PARAM_INT);
            $sth->execute();
            $sql= "SELECT id FROM sites WHERE name =:location" ;
            $sth = $dbh->prepare($sql);
            $sth->bindParam(':location', $location, PDO::PARAM_INT);
            $sth->execute();
            $result = $sth->fetchAll();
            $locId = $result[0]["id"];
        }
    }
    else{
        $error = true;
    }
    // name product
    if (strlen(trim($_POST['name_product']))!== 0){
        $name_product = trim($_POST['name_product']);
    }
    else{
        $error = true;
    }
    // reference product
    if (strlen(trim($_POST['ref_product']))!== 0){
        $ref_product = trim($_POST['ref_product']);
    }
    else{
        $error = true;
    }
    // categories
    if (strlen(trim($_POST['categories']))!== 0){
        $categories = trim($_POST['categories']);
    }
    else{
        $error = true;
    }
    //purchase_date
    if (strlen(trim($_POST['purchase_date']))!== 0){
        $purchase_date = trim($_POST['purchase_date']);
    }
    else{
        $error = true;
    }
    // guarantee date
    if (strlen(trim($_POST['garanty_date']))!== 0){
        $guarantee_date = trim($_POST['garanty_date']);
    }
    else{
        $error = true;
    }
    // price
    if (strlen(trim($_POST['price']))!== 0){
        $price = trim($_POST['price']);
    }
    else{
        $error = true;
    }
    // advice
    if (strlen(trim($_POST['advice']))!== 0){
        $advice = trim($_POST['advice']);
    }
    else{
        $error = true;
    }

        if(!empty($_FILES)){
            $pic_name = $_FILES['picture']['name'];
            $pic_extension = strrchr($pic_name, ".");
        
            $pic_tmp_name = $_FILES['picture']['tmp_name'];
            $pic_dest = 'medias/'.$pic_name;
        
        
            $extAut_pic = array('.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG');
        //Si extension bonne, on continue :
            if (in_array($pic_extension, $extAut_pic)){
                //On déplace le fichier dans le fichier destination
                if(move_uploaded_file($pic_tmp_name, $pic_dest)){
                    //On stocke dans ma bdd
                     $queryp = $dbh->prepare('INSERT INTO pic(file_url, name) VALUES (?,?)');
                    $queryp->execute(array($pic_dest, $pic_name ));
                    echo 'Fichier envoyé avec succès';
                }else{
                    echo 'Une erreur est survenue lors de lenvoi du fichier';
                }
            }else{
                echo 'Seuls les fichiers .jpg, .jpeg et .png sont autorisés';
            }
        }

        if(!empty($_FILES)){
            $man_name = $_FILES['manual']['name'];
            $man_extension = strrchr($man_name, ".");
        
            $man_tmp_name = $_FILES['manual']['tmp_name'];
            $man_dest = 'medias/'.$man_name;
        
        
            $extAut_man = array('.pdf', '.PDF', '.txt', '.TXT');
        //Si extension bonne, on continue :
            if (in_array($man_extension, $extAut_man)){
                //On déplace le fichier dans le fichier destination
                if(move_uploaded_file($man_tmp_name, $man_dest)){
                    //On stocke dans ma bdd
                     $query = $dbh->prepare('INSERT INTO manu(man_url, name) VALUES (?,?)');
                    $query->execute(array($man_dest, $man_name));
                    echo 'Fichier envoyé avec succès';
                }else{
                    echo 'Une erreur est survenue lors de l\'envoi du fichier';
                }
            }else{
                echo 'Seuls les fichiers .pdf, .jpeg et .png sont autorisés';
            }
        }
        
        $sql= "SELECT id FROM pic WHERE file_url =:picture AND name=:name; " ;
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':picture', $pic_dest, PDO::PARAM_STR);
        $sth->bindParam(':name', $pic_name, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetchAll();
        $picId = $result[0]["id"];
        
        $sql2 = "SELECT id FROM manu WHERE man_url =:manual AND name=:name; " ;
        $sth = $dbh->prepare($sql2);
        $sth->bindParam(':manual', $man_dest, PDO::PARAM_STR);
        $sth->bindParam(':name', $man_name, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetchAll();
        $manId = $result[0]["id"];

    // if every field is filled
    if( $error === false){
        // prepare sql request
        $sql = "INSERT INTO `achat_materiel`( `location`, `name_product`, `ref_product`, `categories`, `purchase_date`, `garanty_date`, `price`, `advice`, `picture`, `manual`)VALUES (:location, :name_product, :ref_product, :categories, :purchase_date, :garanty_date, :price, :advice, :picture, :manual)";
        
        // prepare named parameters
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':location', $locId, PDO::PARAM_INT);
        $sth->bindParam(':name_product', $name_product, PDO::PARAM_STR);
        $sth->bindParam(':ref_product', $ref_product, PDO::PARAM_STR);
        $sth->bindParam(':categories', $categories, PDO::PARAM_INT);
        $sth->bindValue(':purchase_date', strftime("%Y-%m-%d", strtotime($purchase_date)), PDO::PARAM_STR);
        $sth->bindValue(':garanty_date', strftime("%Y-%m-%d", strtotime($garanty_date)), PDO::PARAM_STR);
        $sth->bindParam(':price', $price, PDO::PARAM_STR);
        $sth->bindParam(':advice', $advice, PDO::PARAM_STR);
        $sth->bindParam(':picture', $picId, PDO::PARAM_INT);
        $sth->bindParam(':manual', $manId, PDO::PARAM_INT);

        // and ute

    }
    // Redirection if done
    header('Location: ./index.php');
}


/* TWIG */
/* Variables */
$project_title = 'Dashboard Project';

/* Conf */
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);


/* Templates */
$template = $twig->load('add.html');
echo $template->render([
    'project_title' => $project_title
]);