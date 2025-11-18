<?php

$directory = 'C:\_Vincent\Perso\bga\Z Assets Altered\04 - Duster\Duster2';
/*
foreach (glob($directory."*.jpg") as $filename) {
    $file = realpath($filename);
	$newFiles = explode('_',$filename);
	unset($newFiles[6]);
	unset($newFiles[7]);
	$newfileName = implode('_', $newFiles);
	echo $directory.$newfileName;
    rename($file, $directory.$newfileName);
}*/

if ($handle = opendir('C:\_Vincent\Perso\bga\Z Assets Altered\04 - Duster\Duster2')) {
    while (false !== ($fileName = readdir($handle))) {
      if($fileName != '.' && $fileName != '..') {
		  echo $fileName;
		  $newFiles = explode('_',$fileName);
	unset($newFiles[6]);
	unset($newFiles[7]);
	$newfileName = implode('_', $newFiles);
        // $newName = str_replace("SKU#","",$fileName);
         rename('C:\_Vincent\Perso\bga\Z Assets Altered\04 - Duster\Duster2\\'.$fileName, 'C:\_Vincent\Perso\bga\Z Assets Altered\04 - Duster\Duster2\\'.$newfileName.'.jpg');
      }
    }
    closedir($handle);
}
?>
