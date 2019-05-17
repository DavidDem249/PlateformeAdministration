<?php 
    require('config/database.php');

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $req = $db->query("SELECT * FROM groupes WHERE id_group = $id ");
	    $req->execute();
	    $resu = $req->fetch();
    }

    
    $nom = $prenom = $age = $sexe = "";
    $nom_err = $prenom_err = $age_err = $sexe_err = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

    	$nom = $_POST['nom'];
    	$prenom = $_POST['prenom'];
    	$sexe = $_POST['sexe'];
    	$age = $_POST['age'];
    	$sucess = true;

    	if(empty($nom)){

    		$nom_err = "Veillez saisir votre nom svp !";
    		$sucess = false;
    	}

    	if(empty($prenom)){

    		$prenom_err = "Veillez saisir votre prenom svp !";
    		$sucess = false;
    	}

    	if(empty($sexe)){

    		$sexe_err = "Veillez saisir votre sexe svp !";
    		$sucess = false;
    	}

    	if(empty($age)){

    		$nom_err = "Veillez saisir votre nom svp !";
    		$sucess = false;
    	}

    	if($sucess){

    		$inser = $db->prepare("INSERT INTO eleves(nom_elev,prenom_elev,age_elev,sexe_elev,id_group,Archive)
    				             VALUES(:nom,:prenom,:age,:sexe,:group,1)");
    		$inser->bindValue(':nom',$nom,PDO::PARAM_STR);
    		$inser->bindValue(':prenom',$prenom,PDO::PARAM_STR);
    		$inser->bindValue(':age',$age,PDO::PARAM_STR);
    		$inser->bindValue(':sexe',$sexe,PDO::PARAM_STR);
    		$inser->bindValue(':group',$id,PDO::PARAM_INT);

    		$inser->execute();


    	}

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
				Veillez Vous enregistrer dans le groupes <span style="color: blue;">
					<?php echo $resu['nom']; ?></span>
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
							<input type="text" name="nom"  placeholder="" />
                        </td>
                       
                    </tr>
					<tr>
						<td>
							<label>PRENOM* : </label>
						</td>
						<td>
							<input type="text" name="prenom" placeholder="" />
						</td>
					</tr>
					<tr>
						<td>
							<label>SEXE* : </label>
						</td>
						<td>
							<select name="sexe">

								<option value="">Votre nationalité</option>
								<option value="M">Masculin</option>
								<option value="F">Feminin</option>
								
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>AGE* : </label>
						</td>
						<td>
							<input type="number" name="age" placeholder="" />
						</td>
					</tr>
					
					<tr>
                        <td style="text-align: right;"><input type="submit" name="inserer" value="Inserer" /></td>
						<td style="text-align: left;"><span class="retour"><a href="acceuil.php">Retour</a></</td>
					</tr>
				</table>
			</form>
			
		</center>
	</body>
</html>
