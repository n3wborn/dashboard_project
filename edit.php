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

if( isset($_GET['id'])){
    $sql = 'SELECT `id`, `location`,`name_product`,`ref_product`,`categories`,`purchase_date`,`garanty_date`,`price`,`advice`,`picture`,`manual` FROM `achat_materiel`where id=:id';

    $sth = $dbh->prepare( $sql );

    $sth->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

    $sth->execute();

    $data = $sth->fetch(PDO::FETCH_ASSOC);

    $location = $data['location'];
    $name_product= $data['name_product'];
    $ref_product = $data['ref_product'];
    $categories = $data['categories'];
    $purchase_date = $data['purchase_date'];
    $garanty_date = $data['garanty_date'];
    $price = $data['price'];
    $advice = $data['advice'];
    $picture = $data['picture'];
    $manual = $data['manual'];
    $id = htmlentities($_GET['id']);
}

if ( count($_POST) > 0){
    // location
    if (!empty($_POST['location'])){
        if(strlen(trim($_POST['location']))== -1){
            $location = trim($_POST['location']);
            $req2= "INSERT INTO sites (name) VALUES (:location)";
            $sth = $dbh->prepare($req2);
            $sth->bindParam(':location', $location, PDO::PARAM_STR);
            $sth->execute();
            $location=$dbh->lastInsertId();
        }else{
            $location=trim($_POST['location']);
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
    if (!empty($_POST['categories'])){
        if(strlen(trim($_POST['categories']))== -1){
            $location = trim($_POST['categories']);
            $req3= "INSERT INTO cateogry (name) VALUES (:categories)";
            $sth = $dbh->prepare($req3);
            $sth->bindParam(':categories', $categories, PDO::PARAM_STR);
            $sth->execute();
            $categories=$dbh->lastInsertId();
        }else{
            $categories=trim($_POST['categories']);
        }
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
    $file = $_FILES['picture']['name_pic'];
    
    var_dump(base64_encode($file));
    if(!isset($msg)){$msg="";}
    if (isset($_FILES['picture'])&& !empty($file)){
        $tailleMax= 2097152;
        $extensionValide= array('jpg', 'jpeg', 'png', 'gif');
            if($_FILES['picture']['size'] <= $tailleMax)
            {
            $extensionUpload = strtolower(substr(strrchr($file, '.'), 1));
            if(in_array($extensionUpload, $extensionValide))
            {
                $chemin = "medias/".$file;                
                $deplacement = move_uploaded_file($_FILES['picture']['tmp_name'], $chemin);
                if($deplacement){
                    $update_pic= $dbh->prepare('UPDATE pic SET picture=:picture where id = :id');
                    $update_pic ->execute(array($chemin, $file));
                }
                }
            }
            echo"Images must be in the format : .jpg, .jpeg, .gif, .png";
    }
    else{
        $error = true;
    }
    // manual
    $file = $_FILES['manual']['name_pic'];
    if(!isset($msg)){$msg="";}
    if (isset($_FILES['manual'])&& !empty($file)){
        $tailleMax= 2097152;
        $extensionValide= array('pdf', 'txt');
            if($_FILES['manual']['size'] <= $tailleMax)
            {
            $extensionUpload = strtolower(substr(strrchr($file, '.'), 1));
            if(in_array($extensionUpload, $extensionValide))
            {
                $chemin = "medias/".$file;                
                $deplacement = move_uploaded_file($_FILES['manual']['tmp_name'], $chemin);
                if($deplacement){
                    $update_manu= $dbh->prepare('UPDATE manu SET manual=:manual where id = :id');
                    $update_manu ->execute(array($chemin, $file));
                }
                }
            }
            echo"Files must be in the format : .pdf, .txt";
    }
    else{
        $error = true;
    }

    if( $error === false){
        if( isset($_POST['edit'])){
            $sql = 'UPDATE achat_materiel SET location=:location, name_product=:name_product, ref_product=:ref_product, categories=:categories, purchase_date=:purchase_date, garanty_date=:garanty_date, price=:price, advice=:advice, picture=:picture, manual=:manual WHERE id=:id';
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

    if( isset($_POST['edit'])){
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
    }

    // execute
    $sth->execute();

    // Redirection après insertion
    header('Location: ./index.php');
}
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
$template = $twig->load('edit-add.html');
echo $template->render([
	'project_title' => $project_title,
	'datas' => $data
]); 