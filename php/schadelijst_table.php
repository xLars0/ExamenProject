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
        <table class="w3-hoverable w3-striped">
          <tr>
              <?php

              try
              {
                $data = $dbh->query("SHOW COLUMNS FROM schade")->fetchAll();
              } catch(Exception $e) {
                var_dump($e->getMessage());
              }

              $count = 0;

              foreach ($data as $row) {
                $column_names[$count] = $row[0];
                $count++;
                if($row[0] == "id"){
                  echo "<th style=\"display: none;\">{$row[0]}</th>";
                } else {
                  echo "<th>{$row[0]}</th>";
                }
              }
               ?>
          </tr>
            <?php

            try
            {
              $data = $dbh->query("SELECT * FROM `schade`")->fetchAll();
            } catch(Exception $e) {
              var_dump($e->getMessage());
            }

            foreach ($data as $row) {
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
