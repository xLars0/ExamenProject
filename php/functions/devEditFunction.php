<?php
if(isset($_POST['edit'])){

$userID = $_SESSION['id'];
$realname = $_POST['realname'];
$mail = $_POST['mail'];
$phone = $_POST['phone'];
$image = $_FILES['bestand']['name']; //Check of er wel iets met de input gebeurt

$query = $dbh->prepare("SELECT * FROM users WHERE id = :userID");
$query->bindParam(":userID", $userID, PDO::PARAM_INT);
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
            $editCheck = "<p id='editCheck' class='w3-text-red'>Gebruiker bestaat niet.</p>";
        }else{
            if($image == NULL){
                $query = $dbh->prepare("UPDATE users SET name = :realname, mail = :mail, phone = :phone WHERE id = :userID");
            }else{
                $imageFile = file_get_contents($_FILES['bestand']['tmp_name']);
                $query = $dbh->prepare("UPDATE users SET img = :imageFile, name = :realname, mail = :mail, phone = :phone WHERE id = :userID");
                $query->bindParam(":imageFile", $imageFile, PDO::PARAM_STR);
            }
            $query->bindParam(":realname", $realname, PDO::PARAM_STR);
            $query->bindParam(":mail", $mail, PDO::PARAM_STR);
            $query->bindParam(":phone", $phone, PDO::PARAM_STR);
            $query->bindParam(":userID", $userID, PDO::PARAM_STR);
            $query->execute();

            $editCheck = "<p id='editCheck' style='margin-left:225px;'>Informatie opgeslagen.</p>";
        }
}
?>