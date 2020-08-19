<?php require_once 'php/database.php';
require_once "php/functions.php";

/*if (!connected()) {
	header('Location: ./login.php');
}*/


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
    $file = $_FILES['picture'];
  // Get the image and convert into string
    $file = file_get_contents(
    'tmp_name');

    // Encode the image string data into base64
    $data = base64_encode($file);



    if(!isset($msg)){$msg="";}
    if (isset($_FILES['picture'])&& !empty($file)){
        $tailleMax= 2097152;
        $extensionValide= array('jpg', 'jpeg', 'png', 'gif');
            if($_FILES['picture']['size'] <= $tailleMax)
            {
            $extensionUpload = strtolower(substr(strrchr($file['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionValide))
            {
                $chemin = dirname(__FILE__). DIRECTORY_SEPARATOR . "medias/".$file['name'];
                $deplacement = move_uploaded_file($_FILES['picture']['tmp_name'], $chemin);
                echo "<pre>"; print_r($_FILES); echo "</pre>"; die();

                if($deplacement){
                    $update_pic = $dbh->prepare('INSERT INTO pic VALUES picture=:picture where id = :id');
                    $update_pic->bindParam(':picture', $chemin, PDO::PARAM_STR);
                    $update_pic->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
                    $update_pic->execute();
                }
                }
            }
            echo "Images must be in the format : .jpg, .jpeg, .gif, .png";
    }
    else{
        $error = true;
    }
    // manual
    $fileMan = $_FILES['manual'];
    if(!isset($msg)){$msg="";}
    if (isset($_FILES['manual'])&& !empty($fileMan)){
        $tailleMax= 2097152;
        $extensionValide= array('pdf', 'txt');
            if($_FILES['manual']['size'] <= $tailleMax)
            {
            $extensionUpload = strtolower(substr(strrchr($fileMan['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionValide))
            {
                $chemin = dirname(__FILE__). DIRECTORY_SEPARATOR . "medias/".$fileMan['name'];
                $deplacement = move_uploaded_file($_FILES['manual']['tmp_name'], $chemin);
                echo "<pre>"; print_r($_FILES); echo "</pre>"; die();

                if($deplacement){
                    $update_manual= $dbh->prepare('INSERT INTO manu VALUES manual=:manual where id = :id');
                    $update_manual->bindParam(':manual', $chemin, PDO::PARAM_STR);
                    $update_manual->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
                    $update_manual->execute();
                }
                }
            }
            echo "Files must be in the format : .pdf, .txt";
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