<?php
$includePath = "../";
include $includePath.('include/include.php');

if($_SESSION['usertype'] != '1'){
    header("Location: projectPage.php");
}

$editCheck = "";
include ('functions/projEditFunction.php');
?>

<!doctype html>
<html>
<head>
    <title>Company - Project aanpassen</title>
</head>

    <body>

        <div class=" w3-card-3 w3-round">
        <?php
            $projectID = $_GET['id'];
            
            $query = $dbh->prepare("SELECT * FROM projects WHERE id = :projectID");
            $query->bindParam(":projectID", $projectID, PDO::PARAM_INT);
            $query->execute();

            $searchCount = $query->rowCount();

            if($searchCount != 0) {
            
                $data = $query->fetchAll();
                foreach($data as $row) {
                $id = $row["id"];
                    ?><div class="projinfomargin">
                    <div class="infotext">

                    <hr class="inlog-hr" style="margin-bottom:10px !important;">
                    <form autocomplete="off" method="POST" id="form" name="form" enctype="multipart/form-data">
                        <div>
                            <input class="startview inputlogin w3-round" type="text" name="name" title="Projectnaam" placeholder="Projectnaam" value="<?php echo $row['name']; ?>">
                            <br>
                            <input class="startview inputlogin w3-round" type="text" name="location" title="Locatie" placeholder="Locatie" value="<?php echo $row['location']; ?>">
                            <br>
                            <input class="startview inputlogin w3-round" type="date" name="deadline" title="Deadline" placeholder="Deadline" value="<?php echo $row['deadline']; ?>">
                        </div>
                        <hr class="inlog-hr">
                    </div>
                    </div>
                        <div class="editbuttons">
                            <input class="w3-round w3-button companyblue" style="margin-left:13%;" type="submit" title="Opslaan" name="edit" value="Opslaan">
                            <a class="w3-round w3-button companyblue" href="projectInfo.php?id=<?php echo $projectID; ?>">Terug</a>

                            <?php if($editCheck != "") echo $editCheck; ?>
                        </div>
                    </form>
                    <?php
                    }
                }else{

                    ?><h1 class='w3-display-middle'>Gebruiker bestaat niet.</h1><?php
                                
                }
        ?>
        </div>
    </body>

</html>