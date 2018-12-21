<table id="tablediv" class="w3-card w3-margin-top w3-table">
            <tr>
                <th>Projectnaam</th>
                <th>Locatie</th>
                <th>Deadline</th>
            </tr>
<?php

function search($text) {

        $dbh = new PDO('mysql:host=localhost;dbname=projectlist', 'root'); //kan DB niet zelfstandig vinden

        session_start();
        $userID = $_SESSION['id'];
        $userName = $_SESSION['username'];

        if($_SESSION['usertype'] == '3'){
            $query = $dbh->prepare("SELECT connection.projectID AS id, projects.name AS name, projects.location AS location, projects.deadline AS deadline FROM connection INNER JOIN projects ON connection.projectID = projects.id WHERE connection.userID = $userID AND (name LIKE concat('%', :naam, '%') OR location LIKE concat('%', :naam, '%') OR deadline LIKE concat('%', :naam, '%'))");
        }else{
            $query = $dbh->prepare("SELECT * FROM projects WHERE (name LIKE concat('%', :naam, '%') OR location LIKE concat('%', :naam, '%') OR deadline LIKE concat('%', :naam, '%'))");
        }

        $text = htmlspecialchars($text);
        $query -> execute(array('naam' => $text));
        $searchCount = $query->rowCount();

        if($searchCount != 0) {
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                    echo '<tr>';
                        if ($row['name'] == NULL) {
                            echo '<td>-</td>';
                        }else{
                            echo '<td><a style="text-decoration:none;" href="projectInfo.php?id='.$id.'">'.$row['name'].'</a></td>';
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
    }

search($_GET['txt']);
?>
</table>
