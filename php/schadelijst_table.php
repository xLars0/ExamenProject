<?php
$includePath = "../";
include $includePath.('include/include.php');
include "../db/dbConnect.php";
$searchUrl = "functions/schadelijst_table.php";
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script> var searchUrl = "functions/schadelijst_table.php"; </script>
<?php //include ('functions/projectFunction.php'); ?>

<html>
    <head>
        <title>Company - Schadelijst</title>
    </head>

    <body>
      <table>
        <thead>
            <tr>
              <?php
              $stmt = $dbh->query("SELECT * FROM schade");
              while ($row = $stmt->fetch()) {
                  //echo $row['name']."<br />\n";
                }
                echo count($row);
               ?>
                <td>Id</td>
                <td>Name</td>
            </tr>
        </thead>
        <tbody>
        <?php
            /*$connect = mysql_connect("localhost","root", "root");
            if (!$connect) {
                die(mysql_error());
            }
            mysql_select_db("apploymentdevs");
            $results = mysql_query("SELECT * FROM demo LIMIT 10");
            while($row = mysql_fetch_array($results)) {
            ?>
                <tr>
                    <td><?php echo $row['Id']?></td>
                    <td><?php echo $row['Name']?></td>
                </tr>

            <?php
          }*/
            ?>
          </tbody>
        </table>
    </body>
</html>
