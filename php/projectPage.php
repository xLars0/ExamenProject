<?php
$includePath = "../";
include $includePath.('include/include.php');
$searchUrl = "functions/projectSearch.php";
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script> var searchUrl = "functions/projectSearch.php"; </script>
<?php include ('functions/projectFunction.php'); ?>

<html>
    <head>
        <title>Company - Projecten</title>
    </head>

    <body>
        <div class="pagemargin">
            <input class="w3-round-small w3-card startview inputlogin" style="width:60%;" id="search" type="text" name="projecten" placeholder="Zoeken op naam, locatie of deadline">
            <?php
            if($_SESSION['usertype'] == '1'){ ?>
            <a href="addProj.php" class="w3-round w3-card inputlogin addbutton w3-button w3-center" title="Project toevoegen" style="width:12%;">
                <img src="../img/plus.png" class="addimg" draggable="false">
            </a><?php
            } ?>
                <div id="searchbox">
                    <!-- overflow-y auto bij table -->
                </div>
            
        </div>
    </body>
</html>