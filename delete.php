<?php require_once 'php/database.php';
require_once "php/functions.php"; 

if (!connected()) {
	header('Location: ./login.php');
}
if(isset($_POST['id'])){
    $sql=' DELETE FROM achat_materiel WHERE id=:id '
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $sth -> execute();
}

header('Location: ./index.php');
?>