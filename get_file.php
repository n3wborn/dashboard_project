<?php
require_once 'php/database.php';
require_once "php/functions.php";

// exit if not connected
if (!connected()) {
	header('Location: ./login.php');
}

if (isset($_GET['id'])) {
	// sql request to be executed
	$sql='SELECT achat_materiel.picture AS pic, pic.picture AS path FROM achat_materiel INNER JOIN pic ON pic.id WHERE achat_materiel.ID=:id';

	// prepare and execute
	$sth = $dbh->prepare( $sql );
	$sth->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$sth->execute();

	// fetch result
	$results = $sth->fetch(PDO::FETCH_ASSOC);

	// $results['path'] give us the file path
	$file_location = $results['path'];

	// even if everything is ok, we still check if file exist
	if (file_exists($file_location)) {

		var_dump($file_location);
		// if yes -> base64 decode
		// check resolution
		// if not adapted, resize keeping ratio width/height
		//
		// For base64, adapt the header
		//header("Content-type: image/gif");
		// and display datas
		//$data = "";
		$datas = "VEVTVA==";
		echo base64_decode($datas);

		// If no base64 :
		/*echo "<img src=\"$file_location\">";*/
	} else {
		die("Error");
	}



}

?>