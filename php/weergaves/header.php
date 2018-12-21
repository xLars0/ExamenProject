<!DOCTYPE html>
<html>
<?php
session_start();
?>
  <div style="padding: 5px;" class="w3-bar companyblue w3-card">
    <a href="projectPage.php" class="w3-bar-item w3-button">Projecten</a>
    <?php
    if($_SESSION['usertype'] == '1'){
      ?><a href="devPage.php" class="w3-bar-item w3-button">Developers</a>
        <a href="registratie.php" class="w3-bar-item w3-button">Registratie</a><?php
    }elseif($_SESSION['usertype'] == '2'){
      ?><a href="devPage.php" class="w3-bar-item w3-button">Developers</a><?php
    }elseif($_SESSION['usertype'] == '3'){
      ?><a href="profiel.php" class="w3-bar-item w3-button">Uw Profiel</a><?php
    }
    ?>
    <?php include ('../php/functions/login.php'); ?>
  </div>

</html>