<?php
// Check for duplicate columns in an array. When a duplicate is found it is added with ascending numbers added.
// Example: column, column becomes: column1, column2
function CheckDuplicates($columns){

  $new_data = $columns;
  $duplicates = array();
  $dup_count = 1;

  for ($i=0; $i < count($columns); $i++) {
    for ($j=0; $j < count($columns); $j++) {
      if($i != $j){
        if($new_data[$i] == $columns[$j]){
          foreach ($duplicates as $duplicate) {
            if($columns[$j] == $duplicate){
              $dup_count++;
            }
          }
          $duplicates[count($duplicates)+1] = $columns[$i];
          $dup = "{$columns[$i]}{$dup_count}";
          $new_data[$i] = $dup;
          $dup_count = 1;
        }
      }
    }
  }

  for ($i=0; $i < count($new_data); $i++) {
    $new_data[$i] = trim(preg_replace('/\s\s+/', ' ', $new_data[$i]));
  }

  return($new_data);
}

// Checks if an row has empty values. Needs an column array and value array.
// If a value is empty the column will be removed so the query doesnt use unnecessary columns.
function CheckEmptyValues($columns, $values){

  $temporary_columns = array();
  $temporary_values = array();
  $count = 0;
  $empty_count = 0;

  for ($i=0; $i < count($values); $i++) {
    if($values[$i] != ""){
      $temporary_columns[$count] = $columns[$i];
      $temporary_values[$count] = $values[$i];
      $count++;
    } else {
      $empty_count++;
    }
  }

  if($empty_count < count($values)){
    return array($temporary_columns, $temporary_values);
  }
}

// Creates the column part for insert query. Send an array of columns and it return an partial query.
function CreateQueryColumns($data){
  $total_column = "";
  $new_data = CheckDuplicates($data);
  $new_column = "";
  $devide = ",";

  for ($i=0; $i < count($new_data); $i++) {
    $new_column = "{$total_column}`{$new_data[$i]}`";

    if($i != (count($new_data)-1)){
      $total_column = "{$new_column}{$devide}";
    } else {
      $total_column = $new_column;
    }
  }
  return $total_column;
}

// Creates the value part for the insert query. Send an array of columns and it return an partial query.
function CreateQueryValues($data){
  $total_value = "";
  for ($i=0; $i < (count($data)); $i++) {
    $total_value = "{$total_value}'{$data[$i]}'";
    if($i < (count($data)-1)){
      $total_value = "{$total_value},";
    }
  }
  return $total_value;
}

include "../../db/dbConnect.php";

// Inserts data in db.
if(isset($_POST["Import"]))
{
  $excel_column_row = 2;

  $dbh->query("TRUNCATE schade");

    //echo $filename=$_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
        $handle = fopen($_FILES["file"]["tmp_name"], "r");

        //echo "<br><br>";

        $new_data;
        $count = 0;
        $total_column = "";
        $total_value = "";
        $total_column_array = array();

        while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {

          $count++;

          if($count == $excel_column_row){
            $total_column_array = CheckDuplicates($data);
          }

          if($count>$excel_column_row){

            $empty_value_result = CheckEmptyValues($total_column_array, $data);

            if(!empty($empty_value_result)){
              $current_columns = CreateQueryColumns($empty_value_result[0]);
              $current_values = CreateQueryValues($empty_value_result[1]);

              try
              {
                //$dbh->query("TRUNCATE schade");
                $dbh->exec("INSERT into schade({$current_columns}) values ({$current_values});");
              } catch(Exception $e) {
                var_dump($e->getMessage());
              }
            }
          }
        }
        fclose($handle);
    }
    else{
        echo 'Invalid File:Please Upload CSV File';
      }

    header("Location: ../import_Excel.php");
    exit;
}

// Creates new table with given columns
if(isset($_POST["Create"]))
{
  $table_name = "schade";
  $excel_column_row = 2;

  $schade_csv=$_FILES["file"]["tmp_name"];

  $handle = fopen($schade_csv, "r");
  $count = 0;

  while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {

    count($data);

    $count++;

    if($count==$excel_column_row){
      $arr = array();

      for ($i=0; $i < count($data); $i++) {
        $arr[$i] = $data[$i];
      }

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

      foreach ($new_data as $column) {
          /*if($count <1){
            $uniqeu_var = $column;
            $column = "`{$column}` {$int} {$not_null} {$devide}";
            $temporary = "{$query}{$column}";
            $query = $temporary;
          } else {*/
            $column = "`{$column}` {$string} {$null} {$devide}";
            $temporary = "{$query}{$column}";
            $query = $temporary;
          //}
          $count++;
        }

        $query = "CREATE TABLE `{$db}`.`schade` (`id` INT NOT NULL AUTO_INCREMENT , {$query} PRIMARY KEY (`id`)) ENGINE = InnoDB;";

        try
        {
          $dbh->exec("DROP TABLE schade");
          $dbh->exec($query);
          //echo "Query executed: <br>";
          //echo $query;
        } catch(Exception $e) {
          var_dump($e->getMessage());
          //echo "<br> {$query}";
        }
      }
    }
    header("Location: ../import_Excel.php");
    exit;
  }

?>
