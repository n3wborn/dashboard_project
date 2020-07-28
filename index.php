<?php require 'php/database.php';

$sql= 'SELECT `ID`,`location`,`name_product`,`ref_product`,`categories`,`purchase_date`,`garanty_date`,`price`,`advice`,`picture`,`manual` FROM `achat_materiel` ';
    $sth= $dbh->prepare($sql);
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
    $intlDateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::NONE);



    if (count($result)===0){
        echo'<p>Rien n\'a encore été rempli</p>';
    }




/* Twig Vars to render */
$project_title = 'Dashboard Project';



/* TWIG CONF */
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);


/* TWIG: LOAD AND RENDER */
$template = $twig->load('header-nav.html');
echo $template->render(['project_title' => $project_title]);


