<?php

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $dbh->prepare("SELECT id, password, usertype FROM users WHERE username = :username");
    $query->bindParam(":username", $username);
    $query->execute();
    
    $searchCount = $query->rowCount();

    if($searchCount != 0) {
    $data = $query->fetchAll();
        if ($password != NULL) {
            foreach($data as $row) {
                if(password_verify($password,$row['password'])) {
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['usertype'] = $row['usertype'];
                    $_SESSION['username'] = $username;
                    header("Location: php/projectPage.php");
                }
            }
        }else{
            $loginCheck = "<p id='loginCheck' class='w3-text-red'>Inloggegevens kloppen niet.</p>";
        }
    }else{
        $loginCheck = "<p id='loginCheck' class='w3-text-red'>Inloggegevens kloppen niet.</p>";
    }
}

?>