<?php
$includePath = "../";
include $includePath.('include/include.php');
include "../db/dbConnect.php";
$searchUrl = "functions/schadelijst_table.php";
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

<script src="../js/js.js"></script>

<script> var searchUrl = "functions/schadelijst_table.php"; </script>

<html>
    <head>
        <title>Company - Schadelijst</title>
    </head>

    <body>
      <div style="overflow-x: scroll;">
        <table class="w3-hoverable w3-striped">
              <?php

              // Create the table columns
              try
              {
                $data = $dbh->query("SHOW COLUMNS FROM schade")->fetchAll();
              } catch(Exception $e) {
                //var_dump($e->getMessage());
                echo "
                <div class=\"w3-panel w3-red\">
                  <h3>Fout</h3>
                  <p>Er is iets fout gegaan bij het ophalen van de kolommen.</p>
                </div>";
              }

              $count = 0;

              // Create a column for each column in the database.
              foreach ($data as $row) {
                $column_names[$count] = $row[0];
                $count++;
                if($row[0] == "id"){
                  echo "<th>Edit</th>";
                } else {
                  echo "<th>{$row[0]}</th>";
                }
              }

              // Create the table rows
              try
              {
                $data = $dbh->query("SELECT * FROM `schade`")->fetchAll();
              } catch(Exception $e) {
                var_dump($e->getMessage());
                echo "
                <div class=\"w3-panel w3-red\">
                  <h3>Fout</h3>
                  <p>Er is iets fout gegaan bij het ophalen van de data.</p>
                </div>";
              }

              // Create table rows for each row in the database.
              foreach ($data as $row) {
                echo "<tr>";
                for ($i=0; $i < count($column_names); $i++) {
                  if($i == 0){
                    echo "<td>
                      <form enctype=\"multipart/form-data\" method=\"post\" role=\"form\" action=\"detailPage.php\">
                        <input style=\"display: none;\" type=\"text\" name=\"id\" value=\"{$row["{$column_names["{$i}"]}"]}\">
                        <button type=\"submit\" class=\"w3-btn w3-round companyblue\" name=\"Import\" value=\"Import\">Edit</button>
                      </form>
                    </td>";
                  } else {
                    echo "<td> {$row["{$column_names["{$i}"]}"]} </td>";
                  }

                }
                echo "</tr>";
              }

              ?>
        </table>
      </div>
    </body>
</html>
