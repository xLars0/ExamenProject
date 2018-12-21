<?php
$includePath = "../";
include $includePath.('include/include.php');

if($_SESSION['usertype'] != '3'){
    header("Location: projectPage.php");
}

$editCheck = "";
include ('functions/devEditFunction.php');
?>

<!doctype html>
<!-- header('Content-Type: text/html; charset=iso-8859-15');  -->
<html>
<head>
    <title>Company - Profiel aanpassen</title>
</head>

    <body>

        <div class=" w3-card-3 w3-round">
        <?php
            $userID = $_SESSION['id'];
            
            $query = $dbh->prepare("SELECT * FROM users WHERE id = :userID");
            $query->bindParam(":userID", $userID, PDO::PARAM_INT);
            $query->execute();

            $searchCount = $query->rowCount();

            if($searchCount != 0) {
            
                $data = $query->fetchAll();
                foreach($data as $row) {
                $id = $row["id"];
                    ?><div class="infomargin"><?php
                    if ($row['img'] == NULL) {
                        ?><img class="w3-round w3-card editimg" title="<?php echo $row['username']; ?>" src="../img/default-avatar.png" draggable="false" style="margin-top:2%; background-color: white;"><?php
                    }else{
                        ?><img class="w3-round w3-card editimg" title="<?php echo $row['username']; ?>" draggable="false" style="margin-top:10px;" src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" /><?php
                    }
                    ?><div class="infotext">
                        
                        <h2><?php echo $row['username']; ?></h2>
                        
                    <form autocomplete="off" method="POST" id="form" name="form" enctype="multipart/form-data">
                        <div>
                            <input class="startview inputlogin w3-round" type="text" title="Voor- en achternaam" name="realname" placeholder="Voor- en achternaam" value="<?php echo $row['name']; ?>">
                            <br>
                            <input class="startview inputlogin w3-round" type="text" title="E-mail" name="mail" placeholder="E-mail" value="<?php echo $row['mail']; ?>">
                            <br>
                            <input class="startview inputlogin w3-round" type="text" title="Telefoonnummer" name="phone" placeholder="Telefoonnummer" value="<?php echo $row['phone']; ?>">
                        </div>
                    </div>
                    
                    </div>
                        <div class="editbuttons">
                            <input type="file" name="bestand" style="float:left; width:232px; margin-top:5px;" accept=".png, .jpg, .jpeg" />
                            <input class="w3-round w3-button companyblue" style="margin-left:3%;" type="submit" title="Opslaan" name="edit" value="Opslaan">
                            <a class="w3-round w3-button companyblue" href="profiel.php?id=<?php echo $_SESSION['id']; ?>">Terug</a>

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