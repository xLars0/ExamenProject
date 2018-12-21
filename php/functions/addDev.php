<?php
if(isset($_POST['addDev'])){

    $userID = $_POST['userID'];
    $projectID = $_GET['id'];

        $query = $dbh->prepare("SELECT * FROM connection WHERE userID = :userID AND projectID = :projectID");
        $query->bindParam(":userID", $userID, PDO::PARAM_STR);
        $query->bindParam(":projectID", $projectID, PDO::PARAM_STR);
        $query->execute();

        $count = $query->fetchColumn();

        if($count == 0) {
            if($userID == 0){
                $devCheck = "<p id='registerCheck' class='w3-text-red'>Selecteer eerst een developer.</p>";
            }else{

                    $query = $dbh->prepare("INSERT INTO connection SET userID = :userID, projectID = :projectID");
                    $query->bindParam(":userID", $userID, PDO::PARAM_STR);
                    $query->bindParam(":projectID", $projectID, PDO::PARAM_STR);
                    $query->execute();

                    $devCheck = "<p id='registerCheck'>Developer toegevoegd.</p>";
            }
        }else{
            $devCheck = "<p id='registerCheck' class='w3-text-red'>Developer werkt al aan project.</p>";
        }
}
?>