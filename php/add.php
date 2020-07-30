<?php require 'php/database.php';
require_once "php/functions.php"; 

if (!connected()) {
	header('Location: login.php');
}

<?php
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
$error = 'false';

if ( count($_POST) > 0){
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
    // picture
    if (strlen(trim($_POST['picture']))!== 0){
        $picture = trim($_POST['picture']);
    }
    else{
        $error = true;
    }
    // manual
    if (strlen(trim($_POST['manual']))!== 0){
        $manual = trim($_POST['manual']);
    }
    else{
        $error = true;
    }

    if( $error === false){
        $sql = "INSERT INTO `achat_materiel`( `location`, `name_product`, `ref_product`, `categories`, `purchase_date`, `garanty_date`, `price`, `advice`, `picture`, `manual`) VALUES (:location, :name_product, :ref_product, :categories, :purchase_date, :garanty_date, :price, :advice, :picture, :manual )";
    }
    
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':location', $location, PDO::PARAM_STR);
    $sth->bindParam(':name_product', $name_product, PDO::PARAM_STR);
    $sth->bindParam(':ref_product', $ref_product, PDO::PARAM_STR);
    $sth->bindParam(':categories', $categories, PDO::PARAM_STR);
    $sth->bindValue(':purchase_date', strftime("%Y-%m-%d", strtotime($purchase_date)), PDO::PARAM_STR);
    $sth->bindValue(':garanty_date', strftime("%Y-%m-%d", strtotime($garanty_date)), PDO::PARAM_STR);
    $sth->bindParam(':price', $price, PDO::PARAM_STR);
    $sth->bindParam(':advice', $advice, PDO::PARAM_STR);
    $sth->bindParam(':picture', $picture, PDO::PARAM_STR);
    $sth->bindParam(':manual', $manual, PDO::PARAM_STR);



    // execute
    $sth->execute();


    // Redirection après insertion
    header('Location: ../index.php');
}





/* TWIG */
/* Variables */
$project_title = 'Dashboard Project';


/* Conf */
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);


/* Templates */
$template = $twig->load('edit-add.html');
echo $template->render([
    'project_title' => $project_title,
]);

?>