<?php
include "../../db/dbConnect.php";
include "queryFunction.php";

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
