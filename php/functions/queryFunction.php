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

// Creates the value part for the insert query. Send an array of values and it return an partial query.
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

 ?>
