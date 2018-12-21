<?php
        $query = $dbh->prepare("SELECT * FROM users WHERE id = :userID");
        $query->bindParam(":userID", $userID, PDO::PARAM_INT);
        $query->execute();

        $searchCount = $query->rowCount();

        if($searchCount != 0) {
        
            $data = $query->fetchAll();
            foreach($data as $row) {
            $id = $row["id"];
                    echo '<div class="infopadding">';
                        
                        if ($row['img'] == NULL) {
                            echo '<img class="w3-round w3-card imgsize" src="../img/default-avatar.png" draggable="false" style="background-color: white;">';
                        }else{
                            echo '<img class="w3-round w3-card imgsize" draggable="false" style="background-color: white;" src="data:image/jpeg;base64,'.base64_encode($row['img']).'" />';
                        }

                    echo '<div class="infotext">'; //hierop witte achtergrond
                    
                        if ($row['name'] == NULL) {
                            echo '<h1>Geen naam</h1>';
                        }else{
                            echo '<h1>'.$row['name'] .'</h1>';
                        }

                        if ($row['mail'] == NULL) {
                            echo '<h5 style="font-style: italic;" title="Heeft geen e-mail ingesteld"><img src="../img/mail.png" class="infoicon" draggable="false">Geen informatie</h5>';
                        }else{
                            echo '<h5><img src="../img/mail.png" class="infoicon" title="E-mail" draggable="false">'.$row['mail'].'</h5>';
                        }

                        if ($row['phone'] == NULL) {
                            echo '<h5 style="font-style: italic;" title="Heeft geen telefoonnummer ingesteld"><img src="../img/phone.png" class="infoicon" draggable="false">Geen informatie</h5>';
                        }else{
                            echo '<h5><img src="../img/phone.png" class="infoicon" title="Telefoonnummer" draggable="false">'.$row['phone'].'</h5>';
                        }

                        if ($row['location'] == NULL) {
                            echo '<h5 style="font-style: italic;" title="Heeft geen locatie ingesteld"><img src="../img/location.png" class="infoicon" draggable="false">Geen informatie</h5>';
                        }else{
                            echo '<h5><img src="../img/location.png" class="infoicon" title="Locatie" draggable="false">'.$row['location'].'</h5>';
                        }

                    echo '</div>';

                        if($userID == $_SESSION['id']){
                            echo '<a href="devEdit.php" style="margin-top: 140px;" class="w3-round w3-card editbutton w3-button companyblue">Aanpassen</a>';
                        }

                        if($row['usertype'] != '3'){
                            header("Location: devPage.php");
                        }
                    echo '</div>';
                    echo '<hr class="w3-center info-hr">';
                }
        }else{

            ?><h1 class='w3-display-middle'>Gebruiker bestaat niet.</h1><?php
                        
        }
?>