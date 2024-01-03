<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('list.inc.php');

/*
$sourceOld = 'API/';
$sourceNew = 'CoreSetV2/';
$target = 'CoreSetV2/';
$attributes = ['effectDesc', 'supportDesc', 'changedStats'];
*/


$target = "../modules/php/Cards/";
$sourceOld = $target;
$sourceNew = 'CoreSetV2/';
$attributes = ['uid', 'asset', 'mountain', 'ocean', 'forest', 'costHand', 'costReserve', 'flavorText', 'effectDesc', 'supportDesc', 'typeline', 'subtypes', 'changedStats'];


$i = 0;
foreach(ALL_CARDS as $cardId){
	$i++;
//	if($i > 10) break;

	if(!file_exists($sourceOld . $cardId . ".php") or !file_exists($sourceNew . $cardId . ".php")) continue;

	echo "\n##########################################################\n CARD $i: ". $cardId . "\n##########################################################\n";

	$newFile = file_get_contents($sourceNew . $cardId . ".php");
//	echo $newFile;

	$oldFile = file_get_contents($sourceOld . $cardId . ".php");
//	echo $oldFile;

	foreach($attributes as $attr){
		echo "#################\n" . $attr . "\n";
		preg_match('/\''. $attr .'\' => ((\s|.)+?),\n/', $newFile, $matches);

		if(!empty($matches)){
			$newValue = $matches[1];
			echo $newValue . "\n";

			preg_match('/(\''. $attr .'\' => )((\s|.)+?),\n/', $oldFile, $matches);
			if(!empty($matches)){
				$oldFile = preg_replace('/(\''. $attr .'\' => )((\s|.)+?),\n/', '${1}'.$newValue. ",\n", $oldFile);
			} else {
				echo "missing";
				$oldFile = preg_replace('/\];/', "'$attr' => $newValue, \n];", $oldFile);
			}
		}
	}
	
	@mkdir($target . explode("/", $cardId)[0]);
  $fp = fopen($target . $cardId . ".php", 'w');
  fwrite($fp, $oldFile);
	fclose($fp);
}
