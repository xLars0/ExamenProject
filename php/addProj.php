<?php
$includePath = "../";
include $includePath.('include/include.php');

$projCheck = "";
?>

<script>
    setTimeout(function(){
        document.getElementById('registerCheck').style.display = 'none';
    }, 2700);
</script>

<?php include ('functions/addProject.php'); ?>

<html>
    <head>
        <title>Company - Project aanmaken</title>
    </head>

    <body>
        <div class="w3-display-middle w3-center">
        <h2 style="padding-top:10px;">Project aanmaken</h2>
            <hr class="inlog-hr">
            <form autocomplete="off" method="post" action="addProj.php" name="addProject">
                <input class="startview inputlogin w3-round" type="text" name="name" placeholder="Projectnaam *" title="Benodigd veld">
                <br>
                <input class="startview inputlogin w3-round" type="text" name="location" placeholder="Locatie">
                <br>
                <input class="startview inputlogin w3-round" type="date" name="deadline" placeholder="Deadline" title="Deadline">
                <br>
                <?php if($projCheck != "") echo $projCheck; ?>
                <input class="startview buttonview w3-button w3-round" type="submit" name="addProject" value="Toevoegen">
            </form>
            <hr class="inlog-hr">
                <a href="projectPage.php" class="startview buttonview w3-button w3-round">Terug</a>
        </div>
    </body>
</html>