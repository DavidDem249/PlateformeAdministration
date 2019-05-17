<?php 

    try{

        $db = new PDO("mysql:host=localhost;dbname=admin;charset=utf8", "root", "");

    }
    catch(PDOException $e)
    {

        die($e->getMessage());
    }
    
 ?>
