<?php require_once 'database.php'

if(isset($_POST['id'])){
    $sql=' DELETE FROM achat_materiel WHERE id=:id '
}


?>