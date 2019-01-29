<?php

if(isset($_POST["Update"]))
{
  include "queryFunction.php";

  $schade_id = $_POST["id"];

  try
  {
    $columns_bad = $dbh->query("SHOW COLUMNS FROM schade")->fetchAll();
  } catch(Exception $e) {
    var_dump($e->getMessage());
  }

  $count = 0;

  // Create one array with columns instead of multiple arrays with only one row.
  foreach ($columns_bad as $column) {
    $columns[$count] = trim(preg_replace('/\s\s+/', ' ', $column[0]));
    $count++;
  }

  $count = 0;
  $values = array();

  // Get all post data in an array.
  foreach ($columns as $column) {
    if(isset($_POST["data"][$column])){
      $values[$count] = $_POST["data"][$column];
    } else if($count == 0){
      $values[$count] = $_POST["id"];
    } else if($count == 17){
      $values[$count] = $_POST["data"]["Verl. Aanw"];
    } else if($count == 18){
      $values[$count] = $_POST["data"]["Sign. aanw"];
    } else if($count == 23){
      $values[$count] = $_POST["data"]["Aantal (stuks) gaten/ scheuren"];
    }
    $count++;
  }

  for ($i=0; $i < count($columns); $i++) {
    if($values[$i] != ""){
      $query = "UPDATE `schade` SET `{$columns["{$i}"]}` = '{$values["{$i}"]}' WHERE `schade`.`id` = {$schade_id} ";

      try
      {
        $dbh->exec($query);
      } catch(Exception $e) {
        var_dump($e->getMessage());
      }
    }
  }
}

?>
