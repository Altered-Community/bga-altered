<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

foreach (glob('Renamed/*/*.jpg') as $filename) {
  $t = explode('.', $filename);
  $f = $t[0];
  $t2 = explode('/', $t[0]);
  $rarity = substr($f, -1) == 'C' ? 'C' : 'R';
  $faction = explode('_', $f)[3];
  if ($faction == 'OR') {
    $faction = 'OD';
  }

  @mkdir('Assets/' . $rarity . '/' . $faction);
  $f = 'Assets/' . $rarity . '/' . $faction . '/' . trim($t2[2]) . '.jpg';
  echo $f . "\n";
  copy($filename, $f);
}
