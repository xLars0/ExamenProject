<?php
$includePath = "../";
include $includePath.('include/include.php');
include "functions/export.php";

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
          <form class="w3-display-middle w3-center" enctype="multipart/form-data" method="post" role="form" action="schadelijst.csv">
            <h2 class="w3margin">Exporteer de schadelijst</h2>

            <button type="submit" class="w3-btn w3-round w3-margin companylightblue" name="Import" value="Import">Export</button>
            <br>
          </form>
        </div>
    </body>

</html>
