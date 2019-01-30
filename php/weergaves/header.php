<!DOCTYPE html>
<html>
<?php
session_start();
?>
  <div style="padding: 5px;" class="w3-bar companydarkblue w3-card">
    <a href="schadelijst_table.php" class="w3-bar-item w3-button hoverButton">Schadelijst</a>
    <?php
    if($_SESSION['usertype'] == '1'){
      ?>
        <a href="registratie.php" class="w3-bar-item w3-button hoverButton">Registratie</a>
        <a href="import_Excel.php" class="w3-bar-item w3-button hoverButton">Importeren</a>
        <a href="export_Excel.php" class="w3-bar-item w3-button hoverButton">Exporteren</a><?php
    }elseif($_SESSION['usertype'] == '2'){
      ?>
      <a href="import_Excel.php" class="w3-bar-item w3-button hoverButton">Importeren</a>
      <a href="export_Excel.php" class="w3-bar-item w3-button hoverButton">Exporteren</a><?php
    }elseif($_SESSION['usertype'] == '3'){
      ?>
      <a href="import_Excel.php" class="w3-bar-item w3-button hoverButton">Importeren</a>
      <a href="export_Excel.php" class="w3-bar-item w3-button hoverButton">Exporteren</a><?php
    }
    ?>
    <?php include ('../php/functions/login.php'); ?>
  </div>

</html>
