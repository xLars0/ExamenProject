<?php
$includePath = "../";
include $includePath.('include/include.php');

if($_SESSION['usertype'] > '3'){
    header("Location: schadelijst_table.php");
}
?>

<html>

<head>
    <title>QaTool - Importeren</title>
</head>

    <body>
        <div class="pagemargin">
          <?php include "functions/import.php"; ?>

          <form class="w3-display-middle w3-center" enctype="multipart/form-data" method="post" role="form" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <h2 class="w3margin">Selecteer een CSV bestand</h2>
            <br>
            <input class="w3-margin" type="file" name="file" id="file" size="150">
            <br>

            <button type="submit" class="w3-btn w3-round w3-margin companylightblue" name="Import" value="Import">Upload</button>
            <br>
            <button type="submit" class="w3-btn w3-round w3-margin companylightblue" name="Create" value="Create">Create</button>
            <br>
          </form>
        </div>
    </body>

</html>
