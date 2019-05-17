<?php 
	require('config/database.php');

	
	$id_get = $_GET['id'];

	$delete = $db->prepare("DELETE FROM eleves WHERE id_elev = :id_rec");
	$delete->bindValue(':id_rec', $id_get, PDO::PARAM_INT);

	header("location: acceuil.php");
	$delete->execute();
	

?>