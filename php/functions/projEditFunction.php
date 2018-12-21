<?php
if(isset($_POST['edit'])){

    $projectID = $_GET['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $deadline = $_POST['deadline'];

    $query = $dbh->prepare("SELECT * FROM projects WHERE id = :projectID");
    $query->bindParam(":projectID", $projectID, PDO::PARAM_INT);
    $query->execute();
    ?>

    <script>
    setTimeout(function(){
        document.getElementById('editCheck').style.display = 'none';
    }, 2800);
    </script>

    <?php

    $count = $query->fetchColumn();
        if($count == 0) {
            $editCheck = "<p id='editCheck' class='w3-text-red'>Project bestaat niet.</p>";
        }else{

            $query = $dbh->prepare("UPDATE projects SET name = :name, location = :location, deadline = :deadline WHERE id = :projectID");

            $query->bindParam(":name", $name, PDO::PARAM_STR);
            $query->bindParam(":location", $location, PDO::PARAM_STR);
            $query->bindParam(":deadline", $deadline, PDO::PARAM_STR);
            $query->bindParam(":projectID", $projectID, PDO::PARAM_STR);
            $query->execute();

            $editCheck = "<p id='editCheck' style='margin-left:225px;'>Informatie opgeslagen.</p>";
        }
}
?>