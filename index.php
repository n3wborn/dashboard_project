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
    


?>

