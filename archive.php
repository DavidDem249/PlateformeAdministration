<?php
	
	require('config/database.php');
	
	if(isset($_GET['id']) && !empty($_GET['id'])){

		$activ = (int) $_GET['id'];

		$requete = $db->prepare("UPDATE eleves SET Archive = 1 WHERE id_elev = ?");
		$requete->execute(array($activ));

	}	
	
	$data = $db->query("SELECT * FROM eleves WHERE Archive = 0 ORDER BY id_elev DESC");

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Page archives</title>
		<style>
			h1{
				font-size: 40px;
				font-family: verdana;
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
		<h1 style="color: orange">LISTE DES MEMBRES ARCHIVERS</span></h1>
		<br><br>
		<center>
			<table>
				<tr>
					<th>ID</th>
					<th>NOM</th>
					<th>PRENOM</th>
					<th>SEXE</th>
					<th>AGE</th>
					<th>ACTION</th>
				</tr>

				<?php while($result = $data->fetch()) {?>
				<tr>
					<td style="background-color: white;"><?php echo $result['id_elev'] ?></td>
					<td style="background-color: white;"><?php echo $result['nom_elev'] ?></td>
					<td style="background-color: white;"><?php echo $result['prenom_elev'] ?></td>
					<td style="background-color: white;"><?php echo $result['sexe_elev'] ?></td>
					<td style="background-color: white;"><?php echo $result['age_elev']." ans" ?></td>

					<td style="background-color: white;">
						<?php if($result['Archive'] == 0) { ?>
							<a href="archive.php?id=<?php echo $result['id_elev'] ?>">Activer</a>
						<?php }?>
					</td>
				</tr>
				<?php  }?>
			</table>
		</center>
	</body>
</html>