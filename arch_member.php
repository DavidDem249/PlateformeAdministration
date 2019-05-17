<?php
	
	require('config/database.php');

	if(isset($_GET['id']) && !empty($_GET['id'])){

		$arch = (int) $_GET['id'];

		$req = $db->prepare("UPDATE eleves SET Archive = 0 WHERE id_elev = ?");
		$req->execute(array($arch));
		header("location: acceuil.php");
	}
?>