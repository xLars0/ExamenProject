<?php
$includePath = "../";
include $includePath.('include/include.php');

if($_SESSION['usertype'] == '3'){
    header("Location: projectPage.php");
}
?>

<html>

<head>
    <title>Company - Project</title>
</head>

    <body>
        <div class="pagemargin">
          <form class="w3-display-middle w3-center" enctype="multipart/form-data" method="post" role="form" action="./functions/import.php">
            <h2 class="w3margin">Selecteer een CSV bestand</h2>
            <br>
            <input class="w3-margin" type="file" name="file" id="file" size="150">
            <br>

            <button type="submit" class="w3-btn w3-round w3-margin companyblue" name="Import" value="Import">Upload</button>
            <br>
            <button type="submit" class="w3-btn w3-round w3-margin companyblue" name="Create" value="Create">Create</button>
            <br>
          </form>
        </div>
    </body>

</html>
