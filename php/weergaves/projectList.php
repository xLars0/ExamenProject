<div class="list-margin">
<table id="tablediv" class="w3-card w3-table">
            <tr>
                <th>Naam</th>
                <th>E-mail</th>
                <th>Deadline</th>
            </tr>
<?php

    $userName = $_SESSION['username'];

    $query = $dbh->prepare("SELECT connection.projectID AS id, projects.name AS name, projects.location AS location, projects.deadline AS deadline FROM connection INNER JOIN projects ON connection.projectID = projects.id WHERE connection.userID = :userID");
    $query->bindParam(":userID", $userID, PDO::PARAM_STR);
    $query->execute();

    $searchCount = $query->rowCount();

    if($searchCount != 0) {
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
                echo '<tr>';

                    if ($row['name'] == NULL) {
                        echo '<td>-</td>';
                    }elseif($_SESSION['usertype'] != '3'){
                        echo '<td><a style="text-decoration:none;" href="projectInfo.php?id='.$id.'">'.$row['name'].'</a></td>';
                    }else{
                        echo '<td>'.$row['name'].'</td>';
                    }

                    if ($row['location'] == NULL) {
                        echo '<td>-</td>';
                    }else{
                        echo '<td>'.$row['location'].'</td>';
                    }

                    if ($row['deadline'] == 0000-00-00) {
                        echo '<td>-</td>';
                    }else{
                        echo '<td>'.$row['deadline'].'</td>';
                    }

                echo '<tr>';
            }
        }else{
            echo '<tr>';
            echo '<td>Geen projecten gevonden.</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';
        }
?>
</table>
</div>
