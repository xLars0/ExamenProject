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
      <div style="overflow-x:auto;">
        <table class="w3-hoverable">
          <tr>
              <?php
              $stmt = $dbh->query("SHOW COLUMNS FROM schade");
              $column_names = array();
              $count = 0;
              while ($row = $stmt->fetch()) {
                  $column_names[$count] = $row['Field'];
                  $count++;
                  if($row['Field'] == "id"){
                    echo "<th style=\"display: none;\">{$row['Field']}</th>";
                  } else {
                    echo "<th>{$row['Field']}</th>";
                  }
                }
               ?>
          </tr>
            <?php
            $stmt = $dbh->query("SELECT * FROM `schade`");
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                foreach ($column_names as $column_name) {
                  echo "<td> {$row["{$column_name}"]} </td>";
                }
                echo "</tr>";
              }
            ?>
        </table>
      </div>
    </body>
</html>
