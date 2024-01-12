<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'list.inc.php';

$target = '../modules/php/Cards/';
$sourceOld = $target;
$sourceNew = 'CoreSetV2/';

foreach (ALL_CARDS as $cardId) {
  if (!file_exists($sourceOld . $cardId . '.php') or !file_exists($sourceNew . $cardId . '.php')) {
    if (mb_strpos($cardId, 'Rare') !== false) {
      continue;
    }

    if (!file_exists($sourceNew . $cardId . '.php')) {
      echo "\n##########################################################\n";
      echo 'NOT FOUND: ' . $cardId . "\n";
    } else {
      echo $cardId . "\n";
    }
  }
}
