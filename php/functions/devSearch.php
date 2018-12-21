<?php
function search($text) {
    
        $dbh = new PDO('mysql:host=localhost;dbname=projectlist', 'root'); //kan DB niet zelfstandig vinden
        
        session_start();
        $userID = $_SESSION['id'];
        $userName = $_SESSION['username'];
        $query = $dbh->prepare("SELECT * FROM users WHERE (name LIKE concat('%', :naam, '%') OR mail LIKE concat('%', :naam, '%')) AND usertype = 3");
    
        $text = htmlspecialchars($text);
        $query -> execute(array('naam' => $text));
        $searchCount = $query->rowCount();

        if($searchCount != 0) {
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $id = $row['id'];
                echo '<a style="text-decoration:none;" href="devInfo.php?id='.$id.'">';
                    echo '<div style="background-color:white;" class="cardview w3-round-small w3-card">';
                    
                        if ($row['img'] == NULL) {
                            echo '<img title="'.$row['name'] .'" class="w3-round w3-card" src="../img/default-avatar.png" draggable="false" style="width:100px; height:100px;">';
                        }else{
                            echo '<img title="'.$row['name'] .'" class="w3-round w3-card" draggable="false" style="width:100px; height:100px;" src="data:image/jpeg;base64,'.base64_encode($row['img']).'" />';
                        }

                        echo '<h4>'.$row['name'] .'</h4>';
                        
                        if ($row['mail'] == NULL) {
                            echo '<p title="Heeft geen e-mail ingesteld"><img src="../img/mail.png" class="infoicon" draggable="false">-<p>';
                        }else{
                            echo '<p><img src="../img/mail.png" class="infoicon" title="E-mail" draggable="false">'.$row['mail'].'<p>';
                        }

                        if ($row['phone'] == NULL) {
                            echo '<p title="Heeft geen telefoonnummer ingesteld"><img src="../img/phone.png" class="infoicon" draggable="false">-<p>';
                        }else{
                            echo '<p><img src="../img/phone.png" class="infoicon" title="Telefoonnummer" draggable="false">'.$row['phone'].'<p>';
                        }
                    echo '</div>';
                echo '</a>';
                }
            }else{
                echo "<h1 class='w3-display-middle'>Geen resultaten gevonden.</h1>";
            }
    }

search($_GET['txt']);
?>