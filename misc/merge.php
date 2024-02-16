<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'list.inc.php';


/*
$target = 'CoreSetV2/';
$sourceOld = $target;
$sourceNew = 'API/';
$attributes = ['flavorText'];
*/


$target = '../modules/php/Cards/';
$sourceOld = $target;
$sourceNew = 'CoreSetV4/';
$attributes = [
  'uid',
  'asset',
  'name',
  'mountain',
  'ocean',
  'forest',
  'costHand',
  'costReserve',
  'flavorText',
  'effectDesc',
  'supportDesc',
  'typeline',
  'subtypes',
  'changedStats',
	'artist',
];


$i = 0;
foreach (ALL_CARDS as $cardId) {
  $i++;
  //	if($i > 10) break;

  if (!file_exists($sourceOld . $cardId . '.php') or !file_exists($sourceNew . $cardId . '.php')) {
    if (mb_strpos($cardId, 'Rare') !== false) {
      continue;
    }

//    echo "\n##########################################################\n";
//    echo 'NOT FOUND: ' . $cardId . "\n";
    continue;
  }


  //   echo "\n##########################################################\n CARD $i: " .
  //     $cardId .
  //     "\n##########################################################\n";

  $newFile = file_get_contents($sourceNew . $cardId . '.php');
  //	echo $newFile;

  $oldFile = file_get_contents($sourceOld . $cardId . '.php');
  //	echo $oldFile;


  foreach ($attributes as $attr) {
//        echo "#################\n" . $attr . "\n";
//    preg_match('/\'' . $attr . '\' => ((clienttranslate\(\n?)?(\s|.)+?(\n\s+\))?),\n/', $newFile, $matches);
    preg_match('/\'' . $attr . '\' =>( |(\n\s+))((\s|.)+?),\n/', $newFile, $matches);

    if (!empty($matches)) {
      $newValue = $matches[3];
//            echo $newValue . "\n";

      preg_match('/(\'' . $attr . '\' =>)( |(\n\s+))((\s|.|\n)+?),( ?)\n/', $oldFile, $matches);
      if (!empty($matches)) {
        $oldFile = preg_replace('/(\'' . $attr . '\' =>)( |(\n\s+))((\s|.|\n)+?),( ?)\n/', '${1}${2}' . $newValue . ",\n", $oldFile);
      } else {
        echo "missing $attr\n";
        $oldFile = preg_replace('/\];/', "'$attr' => $newValue, \n];", $oldFile);
      }
    }
  }

  @mkdir($target . explode('/', $cardId)[0]);
  $fp = fopen($target . $cardId . '.php', 'w');
  fwrite($fp, $oldFile);
  fclose($fp);
}
