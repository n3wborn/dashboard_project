<<<<<<< HEAD
<?php require_once 'php/database.php';
require_once "php/functions.php";
=======
<?php 
require_once 'php/database.php';
require_once "php/functions.php"; 
>>>>>>> leadev

if (connected()) {
	header('Location: ./index.php');
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
		header('Location: ./index.php');
	} else {
		echo "Utilisateur ou mot de passe vide";
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
$template = $twig->load('login.html');
echo $template->render([
	'project_title' => $project_title
]);
