<?php
if(isset($_POST['addProject'])){

    $name = $_POST['name'];
    $location = $_POST['location'];
    $deadline = $_POST['deadline'];


    if(empty($name)){
        $projCheck = "<p id='registerCheck' class='w3-text-red'>Vul op zijn minst een projectnaam in.</p>";
    }else{

            $query = $dbh->prepare("INSERT INTO projects SET name = :name, location = :location, deadline = :deadline");
            $query->bindParam(":name", $name, PDO::PARAM_STR);
            $query->bindParam(":location", $location, PDO::PARAM_STR);
            $query->bindParam(":deadline", $deadline, PDO::PARAM_STR);
            $query->execute();

            $projCheck = "<p id='registerCheck'>Project is toegevoegd.</p>";
    }
}
?>
