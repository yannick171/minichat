<?php

session_start();


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Registrierung</title>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	  <link rel="stylesheet" href="registrierungsformular.css">
  </head>
  
  <body>
   <fieldset>
     <legend>Regisrierung</legend>
      <div id="conversation">
	   
	   <form action="registrierungstest.php" method="post">
           <label>Email:</label><br>
           <input type="text" id="email"size="27" name="email"><br>
           <label>Mot de passe:</label><br>
           <input type="password" id="message" size="27" name="password"><br>
        <button type="submit" id="envoyer" title="Envoyer"><img width="15px"height="20px" src="envoyer.jpg"></button>
      </form>
	   
	   </div><br />
      
    </fieldset>
	  
  </body>
</html>
