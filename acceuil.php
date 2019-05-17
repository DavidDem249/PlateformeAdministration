<?php
    require('config/database.php');


    $nom_group = $erreur = "";
    $succes = true;

    //Selection des groupes
    $req_select = $db->prepare("SELECT * FROM groupes");
    $req_select->execute();
    $data = $req_select->fetchAll();
    
    

    if(!empty($_POST)){

        $nom_group = $_POST['nom_group'];
        
        if(empty($nom_group)){

            $erreur="Remplissez ce champs";
            $succes = false;
        }

        if($succes){

            $req = $db->prepare("INSERT INTO groupes VALUES(NULL,:nom)");

            $req->bindValue(':nom',$nom_group,PDO::PARAM_STR);
    
            $req->execute();
        }
       
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administration</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700%7CWork+Sans:400,500">
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/fonts/themify-icons/css/themify-icons.css"> 

    <style>
        h2{
           margin-top: 2%;
           text-align:center;
           border: 2px solid orange;
        }
        .liste{
            font-size: 20px;
            font-weight: bold;
            border: 1px solid blue;
            padding: 10px;
            margin: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>PLATEFORME DE GESTION DES ELEVES</h2>
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    <label >NOM DU GROUPE</label>
                    <input type="text" name="nom_group" placeholder="Saisissez un nomveau groupe" class="form-control" />
                    <span style="color:red;"><?php echo $erreur; ?></span>
                </div>

                <div class="col-md-4 col-lg-4">
                    <label for=""></label>
                    <input type="submit" name="enreg" value="Enregistrer" class="form-control btn btn-primary" />
                </div>

            </div>
        </form>
        
        <hr>
    <table>
        <div class="row">
            <div class="col-md-8">
                <span class="liste">LISTE DES GROUPES DEJA ENREGISTRES</span>
            </div>
            <a class="btn btn-success" href="archive.php"><span class="glyphicon glyphicon-envelope"> MEMBRES ARCHIVERS</span></a>
            <br><br>
            <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">NUMERO</th>
                <th scope="col">NOM DU GROUPE</th>
                <th scope="col" style="text-align:center">ACTION</th>
                
            </tr>  
        </thead>
        <?php foreach($data As $resul) { ?>
            <tbody>
                <tr>
                <td style="background-color:lawngreen"><?php echo $resul['id_group'] ?></td>
                <td style="background-color:mediumturquoise"><?php echo $resul['nom'] ?></td>
                <td style="text-align:center;background-color:mediumturquoise;">

                    <a class="btn btn-primary" href="addStudent.php?id=<?php echo $resul['id_group'] ?>">
                    <span class="glyphicon glyphicon-user"></span> AJOUTER 
                    <a>
                    
                    <a class="btn btn-success" href="liste_members.php?id=<?php echo $resul['id_group']; ?>"><span class="glyphicon glyphicon-eye-open"></span> LES MEMBRES
                    </a>

                </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
	   
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>