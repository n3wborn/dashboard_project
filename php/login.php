<?php require_once 'database.php';
require_once "functions.php"; 

if (connected()) {
	header('Location: ../index.php');
}

if(count($_POST) > 0) {
	$user = htmlentities($_POST['user']);
	$password = htmlentities($_POST['password']);

	$sql = 'SELECT * FROM login WHERE login.user = :user';
	$sth = $dbh->prepare($sql);
	$sth->bindParam(':user', $user, PDO::PARAM_STR);
	$sth->execute();
    $result = $sth -> fetch();
    

	if ($user === $result["user"] && pwd_verify($password, $result["password"])) {
		header('Location: ../index.php');
	} else {
		echo "Utilisateur ou mot de passe vide";
	}
	} 
