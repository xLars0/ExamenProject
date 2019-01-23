<?php
include "../db/dbConnect.php";

// Create temporary table, remove id column, select all and delete temporary table.
// The exported file now doesnt have database id`s in it.
try
{
  $dbh->query("CREATE TABLE tschade AS SELECT * FROM schade;");
  $dbh->query("ALTER TABLE tschade DROP COLUMN `id`");

  $columns_bad = $dbh->query("SHOW COLUMNS FROM tschade")->fetchAll();
  $rows = $dbh->query("SELECT * FROM `tschade`")->fetchAll();

  $dbh->query("DROP TABLE tschade");
} catch(Exception $e) {
  var_dump($e->getMessage());
}

$count = 0;

// Create one array with columns instead of multiple arrays with only one row.
foreach ($columns_bad as $column) {
  $columns[$count] = $column[0];
  $count++;
}

// Make an CSV file from database data.
$fp = fopen('schadelijst.csv', 'w');

$delimiter = ';';
fputcsv($fp, $columns, $delimiter);

foreach ($rows as $row) {
    fputcsv($fp, $row, $delimiter);
}

fclose($fp);

 ?>
