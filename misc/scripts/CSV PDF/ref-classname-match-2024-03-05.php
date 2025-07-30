<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function varexport($expression, $return = FALSE)
{
  $export = var_export($expression, TRUE);
  $patterns = [
    "/array \(/" => '[',
    "/^([ ]*)\)(,?)$/m" => '$1]$2',
    "/=>[ ]?\n[ ]+\[/" => '=> [',
    "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
  ];
  $export = preg_replace(array_keys($patterns), array_values($patterns), $export);
  if ((bool)$return) return $export;
  else echo $export;
}


function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '');

  // lowercase
  //  $text = mb_strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}



$factions = [
  'AX' => 'Axiom',
  'BR' => 'Bravos',
  'LY' => 'Lyra',
  'MU' => 'Muna',
  'OR' => 'Ordis',
  'OD' => 'Ordis',
  'YZ' => 'Yzmir',
];


$o = 0;
$i = 0;
$map = [];
if (($handle = fopen("bise_2025.csv", "r")) !== FALSE) {
  while (($row = fgetcsv($handle, 2000, ";")) !== FALSE && $i++ <= 600) {
    if ($i <= 1) {
      continue;
    }

    $uid = $row[0];
    $uid = str_replace('_P_', '_B_', $uid);

    $faction = $row[2];
    if ($faction == 'OR') $faction = 'OD';

    $name = $row[5];
    $rarity = $row[3];

    $slug = slugify($name);
    $className = $faction . "_" . ucfirst(strtolower($rarity)) . "_" . $slug;


    $baseId = $row[1];
    $baseId = str_replace('_P_', '_B_', $baseId);

    $map[$uid] = $faction . "/" . $className;
  }
}

varexport($map);
