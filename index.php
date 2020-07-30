<?php require 'php/database.php';


$sql= 'SELECT achat_materiel.ID, s.name AS place , name_product,ref_product,c.name AS name,purchase_date,garanty_date,price,advice,`picture`,`manual` FROM achat_materiel INNER JOIN category AS c ON achat_materiel.categories=c.id INNER JOIN sites AS s ON achat_materiel.location=s.id ' ;

    $sth= $dbh->prepare($sql);
    
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_ASSOC);
    $intlDateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::NONE);

    

    if (count($result)===0){
        echo'<p>Aucune données n\'a été rentrées</p>';
    }



/* TWIG */
/* Variables */
$project_title = 'Dashboard Project';
$test = 'Is ok';

/* Conf */
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);


/* Templates */
$template = $twig->load('index.html');
echo $template->render([
	'project_title' => $project_title,
	'results' => $result
]);
