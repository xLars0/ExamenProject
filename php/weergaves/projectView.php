<?php
        $projectID = $_GET['id'];

        $query = $dbh->prepare("SELECT * FROM projects WHERE id = :projectID");
        $query->bindParam(":projectID", $projectID, PDO::PARAM_INT);
        $query->execute();

        $searchCount = $query->rowCount();

        if($searchCount != 0) {
        
            $data = $query->fetchAll();
            foreach($data as $row) {
            $id = $row["id"];
                        echo '<div class="projectpadding">';
                        echo '<div class="infotext">'; //hierop witte achtergrond
                        
                        if ($row['name'] == NULL) {
                            echo '<h1>Geen projectnaam</h1>';
                        }else{
                            echo '<h1>'.$row['name'] .'</h1>';
                        }
                        
                        if ($row['location'] == NULL) {
                            echo '<h5 style="font-style: italic;"><img src="../img/location.png" class="infoicon" title="Locatie" draggable="false">Geen informatie</h5>';
                        }else{
                            echo '<h5><img src="../img/location.png" class="infoicon" title="Locatie" draggable="false">'.$row['location'].'</h5>';
                        }

                        if ($row['deadline'] == 0000-00-00) {
                            echo '<h5 style="font-style: italic;"><img src="../img/deadline.png" class="infoicon" title="Deadline" draggable="false">Geen informatie</h5>';
                        }else{
                            echo '<h5><img src="../img/deadline.png" class="infoicon" title="Deadline" draggable="false">'.$row['deadline'].'</h5>';
                        }

                        echo '</div>';

                        if($_SESSION['usertype'] == '1'){
                            echo '<a href="projEdit.php?id='.$id.'" style="margin-top: 120px;" class="w3-round w3-card editbutton w3-button companyblue">Aanpassen</a>';
                            echo '<a href="addDev.php?id='.$id.'" style="margin-top: 120px;" class="w3-round w3-card editbutton w3-button companyblue">Developer toevoegen</a>';
                        }
                        
                        echo '</div>';
                    echo '<hr class="w3-center info-hr">';
                }
        }else{

            ?><h1 class='w3-display-middle'>Project bestaat niet.</h1><?php
                        
        }
?>