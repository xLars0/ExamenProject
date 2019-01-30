<?php
$includePath = "";
include $includePath.('include/loginclude.php');

$loginCheck = "";
?>

<script>
setTimeout(function(){
    document.getElementById('loginCheck').style.display = 'none';
  }, 2700);
</script>

<?php include ('php/functions/loginFunction.php'); ?>

<html>

    <head>
        <title>QaTool - Login</title>
    </head>

    <body class="w3-display-middle w3-center">

        <img src="img/QaToolLogo.png" draggable="false" style="-moz-user-select: none; width:230px; height:175px;">
        <hr class="inlog-hr">
        <form autocomplete="off" method="post" action="index.php" name="login">
            <input class="startview inputlogin w3-round" type="text" name="username" placeholder="Gebruikersnaam">
            <br>
            <input class="startview inputlogin w3-round" type="password" name="password" placeholder="Wachtwoord">
            <br>
            <?php if($loginCheck != "") echo $loginCheck; ?>
            <input class="startview buttonview w3-button w3-round hoverButton" type="submit" name="login" value="Inloggen">
        </form>
        <hr class="inlog-hr">
    </body>

</html>
