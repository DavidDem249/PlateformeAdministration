<?php 
	
	$serveur = "localhost";
	$dbname = "db_jointure";
	$dbuser = "root";
	$dbpass = "";

	try{

		$db = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
		$db->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$jointure = "SELECT ins.nom, ins.prenom, com.commentaire FROM 
					inscrits AS ins INNER JOIN commentaires AS com ON ins.id_insc = com.id_insc
					WHERE ins.id_insc = 1";

		$req = $db->prepare($jointure);
		$req->execute();

		$result = $req->fetchAll();

		echo"<pre>";
			print_r($result);
		echo "</pre>";


	}catch(PDOException $e){

		echo "Erreur de connexion".die($e->getMessage());
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Forum</title>
	</head>
	<body>

	</body>
</html>