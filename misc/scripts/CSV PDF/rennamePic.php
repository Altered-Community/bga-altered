<?php
	$directory = 'D:\Projects\BGA\Eole\eole3';
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

	if ($handle = opendir($directory)) {
		while (false !== ($fileName = readdir($handle))) {
		if($fileName != '.' && $fileName != '..') {
			echo $fileName;
			$newFiles = explode('_',$fileName);
			unset($newFiles[6]);
			unset($newFiles[7]);
			$newfileName = implode('_', $newFiles);
			// $newName = str_replace("SKU#","",$fileName);
			rename($directory.'\\'.$fileName, $directory.'\\'.$newfileName.'.jpg');
		}
		}
		closedir($handle);
	}
?>
