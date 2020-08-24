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
                    //  $sql = $dbh->prepare('INSERT INTO pic(file_url, name) VALUES (?,?)');
                    // $sql->execute(array($pic_name, $pic_dest));
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
                    //  $sql = $dbh->prepare('INSERT INTO manu(man_url, name ) VALUES (?,?)');
                    // $sql->execute(array($man_name, $man_dest));
                    echo 'Fichier envoyé avec succès';
                }else{
                    echo 'Une erreur est survenue lors de l\'envoi du fichier';
                }
            }else{
                echo 'Seuls les fichiers .pdf, et .TXT sont autorisés';
            }
        }
        
        


    // if every field is filled
    if( $error === false){
        // prepare sql request
        $sql = "INSERT INTO `achat_materiel`( `location`, `name_product`, `ref_product`, `categories`, `purchase_date`, `garanty_date`, `price`, `advice`), `pic.name`, `manu.name` VALUES (:location, :name_product, :ref_product, :categories, :purchase_date, :garanty_date, :price, :advice, :picture, :manual)";
    }

    // prepare named parameters
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':location', $location, PDO::PARAM_STR);
    $sth->bindParam(':name_product', $name_product, PDO::PARAM_STR);
    $sth->bindParam(':ref_product', $ref_product, PDO::PARAM_STR);
    $sth->bindParam(':categories', $categories, PDO::PARAM_STR);
    $sth->bindValue(':purchase_date', strftime("%Y-%m-%d", strtotime($purchase_date)), PDO::PARAM_STR);
    $sth->bindValue(':garanty_date', strftime("%Y-%m-%d", strtotime($garanty_date)), PDO::PARAM_STR);
    $sth->bindParam(':price', $price, PDO::PARAM_STR);
    $sth->bindParam(':advice', $advice, PDO::PARAM_STR);
    $sth->bindParam(':picture', $pic_name, PDO::PARAM_STR);
    $sth->bindParam(':manual', $man_name, PDO::PARAM_STR);


    // and ute
    $sth->execute();

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