<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uids = [];
foreach (file('text.txt') as $line) {
  if (substr($line, 0, 7) === 'Equinox') {
    $t = explode('-', $line);
    $uids[] = $t[1];
  }
}

echo count($uids);

$i = 0;
foreach (glob('RawAssets/*.png') as $filename) {
  copy($filename, 'Renamed/' . trim($uids[$i]) . '.png');
  $i++;
}
