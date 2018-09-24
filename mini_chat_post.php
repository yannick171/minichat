<?php

if(isset($_POST['pseudo']) AND isset($_POST['message']))
{
	
	// Connection to database
					try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			}
			catch(Exception $e)
			{
					die('Erreur : '.$e->getMessage());
			}
	
	    $requete = $bdd->prepare('INSERT INTO chat (pseudo,message) VALUES (?,?)');
		$requete->execute(array($_POST['pseudo'],$_POST['message']));	
	
	header('Location: minichat.php');
	
	
	
	
}











?>