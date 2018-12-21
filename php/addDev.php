<?php
$includePath = "../";
include $includePath.('include/include.php');


if($_SESSION['usertype'] != '1'){
    header("Location: projectPage.php");
}
$projectID = $_GET['id'];
$devCheck = "";

include ('functions/addDev.php');
?>
<script>
    setTimeout(function(){
        document.getElementById('registerCheck').style.display = 'none';
    }, 2700);
</script>
<html>

<head>
    <title>Company - Developer aan project</title>
</head>

    <body>
        <div class="w3-card w3-round infoview">
        <?php 
        include ('weergaves/addDevView.php');
        ?>
            <div class="add-list">

            <form autocomplete="off" method="post" action="addDev.php?id=<?php echo $projectID; ?>" name="addDev">
                <select style="float:left;" class="add-margin startview inputlogin w3-select w3-round" name="userID">
                    <option value="0" selected value>Selecteer developer</option>
                <?php
                $userID = $_SESSION['id'];
                $query = $dbh->prepare("SELECT * FROM users WHERE usertype = 3");
                $query->execute();

                $searchCount = $query->rowCount();

                if($searchCount != 0) {
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $id = $row['id'];
                            echo '<option value="'.$id.'">'.$row['name'].'</option>';
                    }
                }else{
                    echo "<h1 class='w3-display-middle'>Geen resultaten gevonden.</h1>";
                }
                ?>
                </select>
                <?php if($devCheck != "") echo $devCheck; ?>
                <input class="startview buttonview w3-button w3-round w3-right" type="submit" name="addDev" value="Toevoegen">
            </form>

            </div>
            </div>
        </div>
    </body>

</html>