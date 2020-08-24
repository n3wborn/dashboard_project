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

		// if yes
		// For base64
		//$datas = base64_decode($file_location);
		//echo base64_decode($datas);
		// if b64:
		// echo '<img src="data:base64,' . $data . '" />';

		// If no base64 :
		echo "$file_location";
	} else {
		die("Error");
	}
}
