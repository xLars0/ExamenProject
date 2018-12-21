<div class="list-margin">
<table id="tablediv" class="w3-card w3-table">
            <tr>
                <th>Naam</th>
                <th>E-mail</th>
                <th>Telefoonnummer</th>
                <th>Locatie</th>
            </tr>
<?php

    $userID = $_SESSION['id'];
    $userName = $_SESSION['username'];

    $query = $dbh->prepare("SELECT connection.userID AS id, users.name AS name,  users.mail AS mail, users.phone AS phone, users.location AS location FROM connection INNER JOIN users ON connection.userID = users.id WHERE connection.projectID = :projectID AND users.usertype = 3");
    $query->bindParam(":projectID", $projectID, PDO::PARAM_STR);
    $query->execute();

    $searchCount = $query->rowCount();

    if($searchCount != 0) {
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
                echo '<tr>';
                    if ($row['name'] == NULL) {
                        echo '<td>-</td>';
                    }elseif($_SESSION['usertype'] != '3'){
                        echo '<td><a style="text-decoration:none;" href="devInfo.php?id='.$id.'">'.$row['name'].'</a></td>';
                    }else{
                        echo '<td>'.$row['name'].'</td>';
                    }

                    if ($row['mail'] == NULL) {
                        echo '<td>-</td>';
                    }else{
                        echo '<td>'.$row['mail'].'</td>';
                    }
                    
                    if ($row['phone'] == NULL) {
                        echo '<td>-</td>';
                    }else{
                        echo '<td>'.$row['phone'].'</td>';
                    }

                    if ($row['location'] == NULL) {
                        echo '<td>-</td>';
                    }else{
                        echo '<td>'.$row['location'].'</td>';
                    }
                echo '<tr>';
            }
        }else{
            echo '<tr>';
            echo '<td>Geen resultaten gevonden.</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';
        }
?>
</table>
</div>