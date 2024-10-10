<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (false) {
  foreach (glob('Assets/*.jpg') as $filename) {
    $t = explode('.', $filename);
    $t2 = explode('/', $t[0]);
    $f = 'Assets/' . trim($t2[1]) . '.jpg';
    echo $f . "\n";
    rename($filename, $f);
  }
}

if (false) {
  foreach (glob('Assets/*.jpg') as $filename) {
    $t = explode('.', $filename);
    $f = $t[0];
    $t2 = explode('/', $t[0]);
    $rarity = substr($f, -1) == 'C' ? 'C' : 'R';

    $f = 'Assets/' . $rarity . '/' . trim($t2[1]) . '.jpg';
    echo $f . "\n";
    rename($filename, $f);
  }
}

if (true) {
  foreach (glob('Assets/C/*.jpg') as $filename) {
    $t = explode('.', $filename);
    $f = $t[0];
    $t2 = explode('/', $t[0]);
    $faction = explode('_', $f)[3];

    $f = 'Assets/C/' . $faction . '/' . trim($t2[2]) . '.jpg';
    echo $f . "\n";
    rename($filename, $f);
  }
}
