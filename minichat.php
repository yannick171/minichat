<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
    </head>
    <style>
    form
    {
        text-align:center;
    }
		body{
			
			text-align:center;
		}
    </style>
    <body>
    
    <form action="mini_chat_post.php" method="post">
        <p>
        <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" /><br />
        <label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />

        <input type="submit" value="Envoyer" />
	</p>
    </form>
		<?php 
		  // Connection to database
					try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			}
			catch(Exception $e)
			{
					die('Erreur : '.$e->getMessage());
			}
	
	    $requete = $bdd->query('SELECT pseudo,message FROM chat');	
		while($donnees = $requete->fetch())
		{
			echo'<p>'.htmlspecialchars($donnees['pseudo']).': '.htmlspecialchars($donnees['message']).'</p>';
		}
		
		
		?>
	</body>
</html>