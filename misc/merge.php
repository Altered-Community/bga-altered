<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('list.inc.php');

$sourceOld = 'CoreSetV2/';
$sourceNew = 'API/';
$target = 'Merge';

//$target = "../../modules/php/Cards/";

$attributes = ['effectDesc'];

$i = 0;
foreach(ALL_CARDS as $cardId){
	$i++;
	if($i > 6) break;

	if(!file_exists($sourceOld . $cardId . ".php") or !file_exists($sourceNew . $cardId . ".php")) continue;

	echo "##########################################################\n CARD $i: ". $cardId . "\n##########################################################\n";

	$newFile = file_get_contents($sourceNew . $cardId . ".php");
	echo $newFile;

	$oldFile = file_get_contents($sourceOld . $cardId . ".php");
	echo $oldFile;

	foreach($attributes as $attr){
		echo "#################\n" . $attr . "\n";
		preg_match('/\''. $attr .'\' => ((\s|.)+?),\n/', $newFile, $matches);
		var_dump($matches);

		if(!empty($matches)){
			$newValue = $matches[1];
			echo $newValue;

			$oldFile = preg_replace('/(\''. $attr .'\' => )((\s|.)+?),\n/', '\1'.$newValue. ",\n", $oldFile);
		}
	}
	
	echo $oldFile;
}
