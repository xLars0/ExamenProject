<?php

if(isset($_POST['register'])){

    $registername = $_POST['username'];
    $realname = $_POST['firstLastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $mail = $_POST['email'];
    $password = $_POST['password'];
    if(empty($_POST['type'])){
        $type = NULL;
    }else{
        $type = $_POST['type'];
    }
    $cPassword = $_POST['cPassword'];


    if(empty($registername) OR empty($realname) OR empty($password) OR empty($type)){
        $pwCheck = "<p id='registerCheck' class='w3-text-red'>Vul de benodigde velden in.</p>";
    }else{

        if($password != $cPassword){

            $pwCheck = "<p id='registerCheck' class='w3-text-red'>Er is iets misgegaan bij het bevestigen van uw wachtwoord.</p>";

        }else{

            $query = $dbh->prepare("SELECT username FROM users WHERE username = :username");
            $query->bindParam(":username", $registername, PDO::PARAM_INT);
            $query->execute();

            $count = $query->fetchColumn();
            if($count == 0) {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $query = $dbh->prepare("INSERT INTO users SET username = :registername, name = :realname, phone = :phoneNumber, mail = :mail, password = :hash, usertype = :type");
                $query->bindParam(":registername", $registername, PDO::PARAM_STR);
                $query->bindParam(":realname", $realname, PDO::PARAM_STR);
                $query->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
                $query->bindParam(":mail", $mail, PDO::PARAM_STR);
                $query->bindParam(":hash", $hash, PDO::PARAM_STR);
                $query->bindParam(":type", $type, PDO::PARAM_STR);
                $query->execute();

                $pwCheck = "<p id='registerCheck'>U bent geregistreerd. U kunt nu teruggaan om in te loggen.</p>";
            }else{
                $pwCheck = "<p id='registerCheck' class='w3-text-red'>Deze gebruikersnaam is al in gebruik.</p>";
            }
        }
    }
}
?>