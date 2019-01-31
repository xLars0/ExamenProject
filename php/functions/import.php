<?php
include "../db/dbConnect.php";
include "functions/queryFunction.php";

// Checks if the file isnt empty or a different filetype.
function CheckFileValidation(){
  $allowed =  array('ms-excel','text/csv');
  $filename = $_FILES["file"]["type"];
  $ext = pathinfo($filename, PATHINFO_EXTENSION);

  if(!$_FILES["file"]["size"] > 0) {
    return 1;
  } else if(!in_array($ext, $allowed) ) {
    return 2;
  } else {
    return 0;
  }
}

// Sends response to page based on error var.
function SendResponse($error) {
  switch ($error) {
    case 0:
        echo "
        <div class=\"w3-panel w3-green\">
          <h3>Succes</h3>
          <p>Data is geïmporteerd/tabel is aangemaakt.</p>
        </div>";
        break;
    case 1:
        echo "
        <div class=\"w3-panel w3-red\">
          <h3>Fout</h3>
          <p>Bestand is leeg.</p>
        </div>";
        break;
    case 2:
        echo "
        <div class=\"w3-panel w3-red\">
          <h3>Fout</h3>
          <p>Bestandstype wordt niet ondersteund. Selecteer a.u.b. een ander type bestand.</p>
        </div>";
        break;
    case 3:
        echo "
        <div class=\"w3-panel w3-red\">
          <h3>Fout</h3>
          <p>Er is iets foutgegaan bij het importeren. Mogelijk is het CSV bestand incorrect opgesteld.</p>
        </div>";
        break;
    case 4:
        echo "
        <div class=\"w3-panel w3-red\">
          <h3>Fout</h3>
          <p>Er is iets foutgegaan bij het genereren van de tabel.</p>
        </div>";
        break;
  }
}

// Inserts data in db.
if(isset($_POST["Import"]))
{
  $excel_column_row = 2;
  $error = CheckFileValidation();

  if($error == 0){

    $dbh->query("TRUNCATE schade");

    $handle = fopen($_FILES["file"]["tmp_name"], "r");

    $new_data;
    $count = 0;
    $total_column = "";
    $total_value = "";
    $total_column_array = array();

    while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {

      $count++;

      // Check the CSV column row on duplicates
      if($count == $excel_column_row){
        $total_column_array = CheckDuplicates($data);
      }

      // Create and execute the query`s.
      if($count>$excel_column_row){

        $empty_value_result = CheckEmptyValues($total_column_array, $data);

        if(!empty($empty_value_result)){

          $current_columns = CreateQueryColumns($empty_value_result[0]);
          $current_values = CreateQueryValues($empty_value_result[1]);

          try
          {
            $dbh->exec("INSERT into schade({$current_columns}) values ({$current_values});");
          } catch(Exception $e) {
            //var_dump($e->getMessage());
            $error = 3;
          }
        }
      }
    }
    fclose($handle);
  }
  SendResponse($error);
}

// Creates new table with given columns, this is only for testing.
/*
if(isset($_POST["Create"]))
{
  $error = CheckFileValidation();

  if($error == 0){
    $table_name = "schade";
    $excel_column_row = 2;

    $schade_csv=$_FILES["file"]["tmp_name"];

    $handle = fopen($schade_csv, "r");
    $count = 0;

    while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {

      $count++;

      if($count==$excel_column_row){
        $arr = array();

        for ($i=0; $i < count($data); $i++) {
          $arr[$i] = $data[$i];
        }

        // Query elements.
        $query = "";
        $temporary = "";
        $devide = ", ";
        $string = "VARCHAR(255)";
        $int = "INT";
        $null = "NULL";
        $not_null = "NOT NULL";

        $count = 0;
        $uniqeu_var;

        $new_data = CheckDuplicates($data);

        // Create the query.
        foreach ($new_data as $column) {

            $column = "`{$column}` {$string} {$null} {$devide}";
            $temporary = "{$query}{$column}";
            $query = $temporary;
            $count++;
          }

          // Add id to the query.
          $query = "CREATE TABLE `{$db}`.`schade` (`id` INT NOT NULL AUTO_INCREMENT , {$query} PRIMARY KEY (`id`)) ENGINE = InnoDB;";

          try
          {
            try {
              $dbh->exec("DROP TABLE schade");
            } catch (Exception $e) {}
            $dbh->exec($query);
            //echo "Query executed: <br>";
            //echo $query;
          } catch(Exception $e) {
            //var_dump($e->getMessage());
            //echo $query;
            $error = 4;
          }
        }
      }
    }
    SendResponse($error);
  }*/

?>
