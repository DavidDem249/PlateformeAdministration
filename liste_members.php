<?php
	
	require('config/database.php');

	if(isset($_GET['id'])){

		$id_recup = $_GET['id'];

		$recup = $db->query("SELECT * FROM groupes WHERE id_group = $id_recup");
		$recup->execute();
		$resu = $recup->fetch();
	}

	/* Prémière methode
	$data = $db->prepare("SELECT * FROM eleves WHERE id_group = $id_recup");

	$data->execute();
	$results = $data->fetchAll(); */

	// deuxième methode
	$data = $db->prepare("SELECT groupes.nom, eleves.id_elev, eleves.nom_elev, eleves.prenom_elev, eleves.sexe_elev,eleves.age_elev,eleves.Archive
		FROM groupes INNER JOIN eleves ON groupes.id_group = eleves.id_group WHERE 
		groupes.id_group = $id_recup AND Archive = 1");


	$data->execute();
	$results = $data->fetchAll();

	
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $resu['nom']; ?></title>
		<style>
			h1{
				font-size: 40px;
				font-family: verdana;
			}
			a{
				text-align: right;
				text-decoration: none;
				font-size: 25px;
			}
			h3{
				color: yellow;
				font-size: 30px;
				font-family: verdana;
				background: green;
			}
			body{
				background-color: rgba(13,115,115);
				}
			table{
				border-collapse: collapse;
			}
			td, th{
				padding: 20px;

			}
			tr th{
				color:orange;
				background-color: rgba(118,10,15);
			}
		</style>

	</head>

	<body>
		<br><br>
		<h1 style="color: orange">BIENVENU DANS LE GROUPE <span style="color: aqua"><?php echo $resu['nom']; ?></span></h1>
		<br><br>
		<center>

			<h3>LES MEMBRES DU GROUPES <?php echo $resu['nom']; ?> <a href="acceuil.php">Retour</a></h3>
			<table>
				<tr>
					<th>ID</th>
					<th>NOM</th>
					<th>PRENOM</th>
					<th>SEXE</th>
					<th>AGE</th>
					<th colspan="3">ACTION</th>
				</tr>

				<?php foreach($results  As $result) {?>
				<tr>
					<td style="background-color: white;"><?php echo $result['id_elev'] ?></td>
					<td style="background-color: white;"><?php echo $result['nom_elev'] ?></td>
					<td style="background-color: white;"><?php echo $result['prenom_elev'] ?></td>
					<td style="background-color: white;"><?php echo $result['sexe_elev'] ?></td>
					<td style="background-color: white;"><?php echo $result['age_elev']." ans" ?></td>


					<td style="background-color: white;"><a href="sup_member.php?id=<?php echo $result['id_elev'] ?>">Supprimer</a></td>
					<td style="background-color: white;"><a href="modif_member.php?id=<?php echo $result['id_elev'] ?>">Modifier</a></td>
					<td style="background-color: white;"><a href="arch_member.php?id=<?php echo $result['id_elev'] ?>">Archivé</a></td>

				</tr>
				<?php  }?>
			</table>
		</center>
	</body>
</html>