<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'list.inc.php';

$repo = '../modules/php/Cards/';
$coreset = 'CoreSetV2/';

foreach (glob($repo . '*/*.php') as $fileName) {
  $t = explode('/', $fileName);
  $classFile = $t[5];
  $cardId = $t[4] . '/' . explode('.', $classFile)[0];

  if (!file_exists($coreset . $cardId . '.php')) {
    echo $cardId . "\n";
  }
}

const FACTION_AX = 'AX';
const FACTION_BR = 'BR';
const FACTION_LY = 'LY';
const FACTION_MU = 'MU';
const FACTION_OD = 'OD';
const FACTION_YZ = 'YZ';

require_once $repo . 'cards.inc.php';

foreach (PRECOS as $faction => $cards) {
  foreach ($cards as $cId => $nbr) {
    $cardId = $faction . '/' . $cId;

    if (!file_exists($coreset . $cardId . '.php')) {
      echo $cardId . "\n";
    }
  }
}
