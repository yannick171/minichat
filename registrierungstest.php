<?php

session_start();
?>
<?php
 
 if(isset($_POST['email']) AND isset($_POST['password'])AND isset($_POST['passwordw'])){
	 $email=htmlspecialchars($_POST['email']);
	 $passwort=htmlspecialchars($_POST['password']);
     $passwortw=htmlspecialchars($_POST['passwordw']);
	 if($passwort==$passwortw){

			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			}
			catch (Exception $e)
			{
					die('Erreur : ' . $e->getMessage());
			}
		 
		    /* On vérifie d'abord que la table existe, si ce n'est pas le cas, 
			on la cree. Dans le cas contraire on verifit si le compte existe */

               $req=$bdd->query(' CREATE TABLE  IF NOT EXISTS `user_accounts` ( `user_id` INT NOT NULL AUTO_INCREMENT ,
                `user_login` VARCHAR(300) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL , PRIMARY KEY (`user_id`)) ENGINE = InnoDB;');


				/* On vérifie d'abord que le compte existe, si ce n'est pas le cas, 
			on s'arrête, on supprime les sessions et on renvoie 0. */
				if(isset( $_SESSION['passwort'])AND isset($_SESSION['email'])){

                    if( $_SESSION['passwort']==$passwort AND $_SESSION['email']==$email){
                        $checkUser = $bdd->prepare("SELECT * FROM user_accounts WHERE  user_login =?");
                        $checkUser->execute(array($_SESSION['$email']));
                        $countUser = $checkUser->rowCount();
                        if($countUser == 0) {
                            // On indique qu'il y a une erreur de type unlog
                            // donc que l'utilisateur connecté n'a pas de compte
                            // On supprime les sessions
                            unset($_SESSION['time']);
                            unset($_SESSION['email']);
                            unset($_SESSION['passwort']);
                            header ('Location: connection.php');
                        }
                        else {
                            // ON PEUT CONTINUER !!!

                            header('Location: chat.php');
                        }
                        $checkUser->closeCursor();
                }

				}
                    else{
                        $checkUser = $bdd->prepare("INSERT INTO user_accounts(user_id,user_login) VALUES(?,?)");
                        $checkUser->execute(array("", $email));
                            $_SESSION['time']=60;
                            $_SESSION['passwort']=$passwort;
                            $_SESSION['email']=$email;
                            $checkUser->closeCursor();
                            $mail = 'yannick.watat.sunou@uni-oldenburg.de'; // Déclaration de l'adresse de destination.
                            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
                                {
                                    $passage_ligne = "\r\n";
                                }
                                else
                                    {
                                        $passage_ligne = "\n";
                                                            }
                                        //=====Déclaration des messages au format texte et au format HTML.

                                       $message_html = "<html><head></head><body><a href='http://localhost/registrierungstest/registrierungstest.php?conf=yes'>click ici pour confirmer</a>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
                                        //==========

                                        //=====Création de la boundary
                                         $boundary = "-----=".md5(rand());
                                            //==========

                                             //=====Définition du sujet.
                                                            $sujet = "Hey mon ami !";
                                                        //=========

                                                        //=====Création du header de l'e-mail.
                                                            $header = "From: \"Yannick\"<kapitainyannick@gmail.com>".$passage_ligne;
                                                            $header.= "Reply-to: \"WeaponsB\" <kapitainyannick@gmail.com>".$passage_ligne;
                                                            $header.= "MIME-Version: 1.0".$passage_ligne;
                                                            $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
                                                        //==========

                                                        //=====Création du message.
                                                            $message = $passage_ligne."--".$boundary.$passage_ligne;
                                                        //=====Ajout du message au format texte.

                                                        //==========
                                                            $message.= $passage_ligne."--".$boundary.$passage_ligne;
                                                        //=====Ajout du message au format HTML
                                                            $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
                                                            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                                                            $message.= $passage_ligne.$message_html.$passage_ligne;
                                                         //==========
                                                            $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
                                                        //==========

                                                        //=====Envoi de l'e-mail.
                                                            mail($mail,$sujet,$message,$header);
                                                            //==========
                                                  echo'<script> alert("on vous a envoyer un mail de confirmation")</script>';

                    }


			}

	 else{
		 
		 
              echo'
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
                   
                       <script> alert("les mots de passe sont different");</script>
                   </div><br />
                  
                </fieldset>
                  
              </body>
            </html>';
	 }
 }

elseif(isset($_POST['email'])AND isset($_POST['password'])){

    $email=htmlspecialchars($_POST['email']);
    $passwort=htmlspecialchars($_POST['password']);

        if($_SESSION['passwort']==$passwort AND $_SESSION['$email']==$email){
            header('Location: chat.php');
        }

	else{
		echo'<script>alert("enregistrez vous dabord")</script>';
        header('Location: registrierungsformular.php');

	}

}
elseif (isset($_POST['passwordw'])){
    header('Location: registrierungsformular.php');

}
else{
    if(isset($_GET['conf'])){
        $conf=htmlspecialchars($_GET['conf']);
    }
    if($conf=="yes"){
        header('Location: chat.php');
    }

}


?>