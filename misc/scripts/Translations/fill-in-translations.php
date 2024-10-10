<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = file_get_contents('strings.json');
$strings = json_decode($data, true);

$filename = 'translation-keys-09-08';

if (($handle = fopen("$filename.csv", 'r')) === false) {
  die("Error while loading the file: $filename");
}

$i = 0;

$langs = ['FR', 'ES', 'IT', 'DE'];

$found = 0;
$output = fopen("$filename-filled.csv", 'w');
while (($row = fgetcsv($handle, 2000, ';')) !== false && $i++ <= 1000) {
  if ($i > 1) {
    $id = $row[0];
    $str = $row[1];

    if (isset($strings[$str])) {
      foreach ($langs as $j => $lang) {
        $row[3 + $j] = $strings[$str][$lang];
      }
      $found++;
      $row[7] = 1;
    }
    else {
      $row[7] = 0;
    }
  } else {
    $row[7] = "LOCK";
  }

  fputcsv($output, $row, ",");
}

echo "Found: $found / $i";
fclose($output);
fclose($handle);
