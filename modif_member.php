<?php 
    require('config/database.php');

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $req = $db->query("SELECT * FROM eleves WHERE id_elev = $id");
	    $req->execute();
	    $resu = $req->fetch();

	    $nom_recup = $resu['nom_elev'];
	    $prenom_recup = $resu['prenom_elev'];
	    $sexe_recup = $resu['sexe_elev'];
	    $age_recup = $resu['age_elev'];
    }


    if($_SERVER['REQUEST_METHOD'] == 'POST'){

    	$nom = $_POST['nom'];
    	$prenom = $_POST['prenom'];
    	$age = $_POST['age'];
    	$sexe = $_POST['sexe'];
    	
		$update = $db->prepare("UPDATE eleves SET nom_elev=:nom,prenom_elev=:prenom,sexe_elev=:sexe,age_elev=:age,id_group=:group,1)");

		$update->bindValue(':nom',$nom,PDO::PARAM_STR);
		$update->bindValue(':prenom',$prenom,PDO::PARAM_STR);
		$update->bindValue(':age',$age,PDO::PARAM_STR);
		$update->bindValue(':sexe',$sexe,PDO::PARAM_STR);
		$update->bindValue(':group',$id,PDO::PARAM_INT);

		$update->execute();
		header("location: liste_members.php");


    	

    }

    
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Ajouter éève</title>
		<link href="styles/style.css" rel="stylesheet" />
	</head>
	<body>
		
		<div class="groupe">
			<h1 style="color: green;">
				MODIFICATION DES INFORMATIONS
			</h1>
		</div><br>
		<h2>ENREGISTREMENT D'UN ETUDIANT</h2>
		<center>
            
			<form method="POST" action="#">
				<table>
					<tr>
                       
						<td>
							<label>NOM* : </label>
						</td>
						<td>
							<input type="text" name="nom" value="<?php echo $nom_recup ?>" placeholder="" />
                        </td>
                       
                    </tr>
					<tr>
						<td>
							<label>PRENOM* : </label>
						</td>
						<td>
							<input type="text" name="prenom" value="<?php echo $prenom_recup ?>" placeholder="" />
						</td>
					</tr>
					<tr>
						<td>
							<label>SEXE* : </label>
						</td>
						<td>
							<select name="sexe">

								<option value="">Votre nationalité</option>
								<option value="<?php if($resu['sexe_elev'] == 'M'){ echo $sexe_recup; } ?>">Masculin</option>
								<option value="<?php if($resu['sexe_elev'] == 'F'){ echo $sexe_recup; } ?>">Feminin</option>
								
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>AGE* : </label>
						</td>
						<td>
							<input type="number" name="age" value="<?php echo $age_recup ?>" placeholder="" />
						</td>
					</tr>
					
					<tr>
                        <td style="text-align: right;"><input type="submit" name="inserer" value="Modifier" /></td>
						<td style="text-align: left;"><span class="retour"><a href="acceuil.php">Retour</a></</td>
					</tr>
				</table>
			</form>
			
		</center>
	</body>
</html>
