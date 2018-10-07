<?php

session_start();


?>
<?php echo '
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Chat jQuery</title>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	  <link rel="stylesheet" href="chat.css">
  </head>
  
  <body>
   <fieldset>
     <legend>Un chat en jQuery</legend>
      <div id="conversation"></div><br />
      <form action="#" method="post">';
        echo '<input type="text" id="nom" value="'.$_SESSION['email'].'" size="25">';
        echo '<input type="text" id="message" size="27">
        <button type="button" id="envoyer" title="Envoyer"><img width="15px"height="20px" src="envoyer.jpg"></button>
          <a href="logout.php"><input type="button" id=""size="16" value="deconnecter"></a>

      </form>
    </fieldset>
	  <script>
	  
	    $(function() {
    afficheConversation();
      
    $("#envoyer").click(function() {
        var nom = $("#nom").val();
        var message = $("#message").val();
        $.post("chats.php", {
            "nom": nom,
            "message": message
        }, afficheConversation);
    });

    function afficheConversation() {
      $("#conversation").load("ac.htm");
      $("#message").val("");
      $("#message").focus();
    }
      
    setInterval(afficheConversation, 10000);
  });
	  
	  </script>
  </body>
</html>';

?>

