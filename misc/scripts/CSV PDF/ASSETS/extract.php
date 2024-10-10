<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nPage = $argv[1];
$needExtraction = $argv[2] == 1;
$sizeThreshold = $argv[3];
$extractUids = $argv[4] == 1;
$nCards = 21;

if ($needExtraction) {
  $files = glob('tmp/*.png');
  foreach ($files as $file) {
    if (is_file($file)) {
      unlink($file);
    }
  }

  echo "Start images extraction\n";
  exec("pdfimages ALT_CORE_23-11-14.pdf -f $nPage -l $nPage -png tmp/card");
  echo "End of images extraction\n";
}

$filenames = [];
foreach (glob('tmp/*.png') as $filename) {
  if (filesize($filename) > $sizeThreshold * 1000) {
    $filenames[] = $filename;
  }
}

echo count($filenames) . " asset found less than $sizeThreshold ko \n";
if (count($filenames) != $nCards) {
  var_dump($filenames);
  die("Not $nCards assets found \n");
}

echo "Extracting card uids \n";
exec("pdftotext -f $nPage -l $nPage -layout ALT_CORE_23-11-14.pdf tmp/text.txt");

if ($extractUids) {
  $text = '';
  foreach (file('tmp/text.txt') as $line) {
    $out = [];
    preg_match_all('|Equinox Prototype - ([^- ]+) -|', $line, $out, PREG_PATTERN_ORDER);
    if (!empty($out[1])) {
      foreach ($out[1] as $uid) {
        $text .= trim($uid) . "\n";
      }
    }

    //		if(substr( $line, 0, 7 ) === "Equinox"){
    //			$t = explode('-', $line);
    //			$text .= trim($t[1]) . "\n";
    //		}
  }
  file_put_contents('tmp/uids.txt', $text);
}

$uids = [];
foreach (file('tmp/uids.txt') as $line) {
  $uids[] = trim($line);
}

echo count($uids) . " card uids found\n";
if (count($uids) != $nCards) {
  die("Not $nCards uids found \n");
}

echo "Start renaming \n";
@mkdir("Renamed/$nPage");
for ($i = 0; $i < $nCards; $i++) {
  $filename = $filenames[$i];
  $uid = trim($uids[$i]);
  exec("convert \"$filename\" -resize 372x505 \"Renamed/$nPage/$uid.jpg\"");
  //	copy($filenames[$i], "Renamed/$nPage/" . trim($uids[$i]) . ".png");
}
echo "End renaming \n";
