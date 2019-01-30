<!DOCTYPE html>
<html>
<?php
session_start();
?>
  <div style="padding: 5px;" class="w3-bar companydarkblue w3-card">
    <a href="schadelijst_table.php" class="w3-bar-item w3-button">Schadelijst</a>
    <?php
    if($_SESSION['usertype'] == '1'){
      ?>
        <a href="registratie.php" class="w3-bar-item w3-button">Registratie</a>
        <a href="import_Excel.php" class="w3-bar-item w3-button">Importeren</a>
        <a href="export_Excel.php" class="w3-bar-item w3-button">Exporteren</a><?php
    }elseif($_SESSION['usertype'] == '2'){
      ?><a href="devPage.php" class="w3-bar-item w3-button">Medewerkers</a><?php
    }elseif($_SESSION['usertype'] == '3'){
      ?><a href="profiel.php" class="w3-bar-item w3-button">Uw Profiel</a><?php
    }
    ?>
    <?php include ('../php/functions/login.php'); ?>
  </div>

</html>
