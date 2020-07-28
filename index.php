<?php require 'php/database.php'; 

$sql= 'SELECT * FROM category';
    $sth= $dbh->prepare($sql);
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

?>

