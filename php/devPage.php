<?php
$includePath = "../";
include $includePath.('include/include.php');

if($_SESSION['usertype'] == '3'){
    header("Location: projectPage.php");
}
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script> var searchUrl = "functions/devSearch.php"; </script>
<?php include ('functions/projectFunction.php'); ?>

<html>
    <head>
        <title>Company - Projecten</title>
    </head>

    <body>
        <div class="pagemargin">
            <input class="w3-round-small w3-card startview inputlogin" style="width:60%;" id="search" type="text" name="developers" placeholder="Zoeken op naam of e-mail">
                <div style="margin-top:1%;" class="pagescroll devView w3-round" id="searchbox">
                </div>
        </div>
    </body>
</html>