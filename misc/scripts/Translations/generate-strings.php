<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// UTILS
function varexport($expression, $return = false)
{
  $export = var_export($expression, true);
  $patterns = [
    '/array \(/' => '[',
    "/^([ ]*)\)(,?)$/m" => '$1]$2',
    "/=>[ ]?\n[ ]+\[/" => '=> [',
    "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
  ];
  $export = preg_replace(array_keys($patterns), array_values($patterns), $export);
  if ((bool) $return) {
    return $export;
  } else {
    echo $export;
  }
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

// TRANSLATABLE STRINGS
$strings = [];
function addString($str, $ctx, $field)
{
  global $strings;

  if (empty($str)) {
    return;
  }

  if (array_key_exists($str, $strings)) {
    $strings[$str]['ctx'][] = $ctx;
  } else {
    $strings[$str] = [
      'EN' => $str,
      'ctx' => [$ctx],
      'type' => $field,
    ];
  }
}

function addTranslation($str, $translation, $lang)
{
  global $strings;

  if (empty($str)) {
    return;
  }

  if (!array_key_exists($str, $strings)) {
    echo "ERROR: missing string : $str \n";
  } else {
    $strings[$str][$lang] = $translation;
  }
}

// OPEN THE FILES
$langs = ['EN', 'FR', 'DE', 'ES', 'IT'];
$handles = [];
foreach ($langs as $lang) {
  if (($handle = fopen("Cards/Cards-$lang.csv", 'r')) !== false) {
    $handles[] = $handle;
  } else {
    die("Invalid file : $fileName");
  }
}

// FLAVOR
$flavors = [];
if (($handle = fopen('../Flavor/Flavor.csv', 'r')) !== false) {
  $i = 0;
  while (($row = fgetcsv($handle, 2000, ';')) !== false && $i++ <= 600) {
    if ($i <= 1) {
      continue;
    }

    $uid = $row[1];
    $flavors[$uid] = [];
    foreach ($langs as $j => $lang) {
      $flavors[$uid][$lang] = $row[3 + $j];
    }
  }
}

// HEROS
$heroes = [
  'EN' => 'FACTION Hero',
  'FR' => 'Héros FACTION',
  'DE' => 'Held FACTION',
  'ES' => 'Héroe FACTION',
  'IT' => 'Eroe FACTION',
];

$factions = [
  'AX' => 'Axiom',
  'BR' => 'Bravos',
  'LY' => 'Lyra',
  'MU' => 'Muna',
  'OR' => 'Ordis',
  'YZ' => 'Yzmir',
];

// SUBTYPE
$subtypes = [];
if (($handle = fopen('Types/Subtypes.csv', 'r')) !== false) {
  $i = 0;
  while (($row = fgetcsv($handle, 2000, ',')) !== false && $i++ <= 100) {
    if ($i <= 1) {
      continue;
    }

    $uid = $row[2];
    $subtypes[$uid] = [];
    foreach ($langs as $j => $lang) {
      $subtypes[$uid][$lang] = $row[3 + $j];
    }
  }
}


// PARSE THEM
function getNextRows()
{
  global $handles;

  $rows = [];
  foreach ($handles as $handle) {
    $row = fgetcsv($handle, 2000, ',');
    if ($row === false) {
      return false;
    }
    $rows[] = $row;
  }

  return $rows;
}

// GET SINGLE CARD INFO
function extractCardInfos($row)
{
  $uid = $row[0];

  $faction = $row[2];
  if ($faction == 'OR') {
    $faction = 'OD';
  }

  $name = $row[5];
  $rarity = $row[3];

  $slug = slugify($name);
  $className = $faction . '_' . ucfirst(strtolower($rarity)) . '_' . $slug;

  $type = $row[6];
  $subtypes = explode(" ", $row[7]);

  return [$className, $type, $subtypes];
}

function extractStrings($row, $lang, $infos)
{
  global $flavors, $subtypes, $heroes, $factions;

  $name = $row[5];

  $type = $infos[1];
  $subtype = $infos[2];
  $typeline = '';

  if($type == 'HERO'){
    $typeline = str_replace('FACTION', $factions[$row[2]], $heroes[$lang]);
  } else {
    $typeline = ucwords($subtypes[$type][$lang]);
  }


  if(!empty($subtype)){
    $t = [];
    foreach($subtype as $s){
      if(empty($s)) continue;

      if(isset($subtypes[$s])){
        $t[] = ucwords($subtypes[$s][$lang]);
      } else {
        echo "MISSING SUBTYPE : $s\n";
      }
    }

    if(!empty($t)){
      $typeline .= " - " . implode(", ", $t);
    }
  }

  $effect = $row[13];
	replaceBracket($effect);
  $echo = $row[14];
	replaceBracket($echo);

  $baseId = $row[1];
  $flavor = isset($flavors[$baseId][$lang]) ? $flavors[$baseId][$lang] : '';

  return [$name, $effect, $echo, $flavor, $typeline];
}
$fields = ['name', 'effect', 'echo', 'flavor', 'typeline'];

// Headers
getNextRows();

// Go through all cards
$i = 0;
while (($rows = getNextRows()) !== false && $i++ < 600) {
  $infos = extractCardInfos($rows[0]);
  $ctx = $infos[0];
//  echo $ctx . "\n";

  $extracted = [];
  foreach ($langs as $j => $lang) {
    $extracted[$lang] = extractStrings($rows[$j], $lang, $infos);
  }

  foreach ($fields as $j => $field) {
    $str = $extracted['EN'][$j];
    addString($str, $ctx, $field);

    foreach ($langs as $lang) {
      if ($lang == 'EN') {
        continue;
      }
      addTranslation($str, $extracted[$lang][$j], $lang);
    }
  }
}


function replaceBracket(&$str)
{
	$str = str_replace("[", "<", $str);
	$str = str_replace("]", ">", $str);
}


// KEYWORDS
$flavors = [];
if (($handle = fopen('Keywords/Keywords.csv', 'r')) !== false) {
  $i = 0;
  while (($row = fgetcsv($handle, 2000, ',')) !== false && $i++ <= 600) {
    if ($i <= 2) {
      continue;
    }

    $output = $row[2];
    $reminder = $row[3];
    addString($output, 'Cards.js', 'Keyword');
    addString($reminder, 'Cards.js', 'Reminder');

    foreach ($langs as $j => $lang) {
      if($lang == 'EN') continue;

      addTranslation($output, $row[2 + $j * 3], $lang);
      addTranslation($reminder, $row[3 + $j * 3], $lang);
    }
  }
}



$json = json_encode($strings, JSON_UNESCAPED_UNICODE);
$bytes = file_put_contents('strings.json', $json);
