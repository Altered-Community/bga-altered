<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include_once('../Artists/artists.inc.php');
//include_once('../Flavor/flavors.inc.php');
//include_once('starters.inc.php');
//echo count(ARTISTS);

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

function replaceBracket(&$str)
{
  $str = str_replace("[", "<", $str);
  $str = str_replace("]", ">", $str);
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
if (($handle = fopen("eole.csv", "r")) !== FALSE) {
  while (($row = fgetcsv($handle, 2000, ";")) !== FALSE && $i++ <= 600) {
    if ($i <= 1) {
      continue;
    }
    //var_dump($row);

    $uid = $row[0];
    //$uid = str_replace('_P_', '_B_', $uid);
    $faction = $row[2];
    if ($faction == 'OR') $faction = 'OD';

    $name = $row[4];
    // echo ($name);
    $rarity = $row[3];
    //		if($rarity == 'RARE') continue;

    $type = $row[9];
    $subtype = $row[10];
    $typeline = '';
    if ($subtype == '') {
      if ($type == 'HERO')
        $typeline = $factions[$faction] . " Hero";
      else
        $typeline = ucwords(strtolower($type));
    } else
      $typeline = ucwords(strtolower($type)) . " - " .  ucwords(strtolower(str_replace("_", " ", $subtype)));

    if ($row[9] == 'EXPEDITION_PERMANENT') {
      $subtype .= ' EXPEDITION';
      $type = 'PERMANENT';
    } elseif ($row[9] == 'LANDMARK_PERMANENT') {
      $subtype .= ' LANDMARK';
      $type = 'PERMANENT';
    }
	
    $slug = slugify($name);
    $className = $faction . "_" . ucfirst(strtolower($rarity)) . "_" . $slug;


    // Clienttranslate only if in starters
    $inStarter = true;
    $ctr1 = $inStarter ? 'clienttranslate(' : '';
    $ctr2 = $inStarter ? ')' : '';

    echo "	\"$className\": '$uid',\n";
    //		continue;

    $changedStats = [];
    if (preg_match('/#[0-9]#/', $row[13])) $changedStats[] = 'forest';
    if (preg_match('/#[0-9]#/', $row[14])) $changedStats[] = 'mountain';
    if (preg_match('/#[0-9]#/', $row[15])) $changedStats[] = 'ocean';
    if (preg_match('/#[0-9]#/', $row[11])) $changedStats[] = 'costHand';
    if (preg_match('/#[0-9]#/', $row[12])) $changedStats[] = 'costReserve';

    $forest = str_replace('#', '', $row[13]);
    $mountain = str_replace('#', '', $row[14]);
    $water = str_replace('#', '', $row[15]);

    $effect = $row[16];
    $echo = $row[17];
    replaceBracket($effect);
    replaceBracket($echo);

    $cost = str_replace('#', '', $row[11]);
    $costMemory = str_replace('#', '', $row[12]);

    $baseId = $row[1];
    //$baseId = str_replace('_P_', '_B_', $baseId);
    $artist = $row[32];
    $flavor =  $row[26];

    $asset = str_replace('_R2', '_R', $uid);
    $asset = str_replace('_R1', '_R', $asset);
    // $type =    str_replace('LANDMARK_', '', $row[6]);
    // $type =    str_replace('EXPEDITION_', '', $type);


    @mkdir($faction);

    $fp = fopen("$faction/$className.php", 'w');
    // print($className);
    fwrite($fp, "<?php
namespace ALT\Cards\\" . $faction . ";
use ALT\Helpers\FT;

class " . $className . " extends \ALT\Models\Card
{
  public function __construct(\$row){
		parent::__construct(\$row);
        \$this->properties = [
            'uid' => '" . $uid . "',
            'asset'  => '" . $asset . "',

    	'faction'  => FACTION_" . strtoupper($faction) . ",
    	'rarity'  => RARITY_" . strtoupper($rarity) . ",
    	'name'  => $ctr1\"" . $name . "\"$ctr2,
      'typeline' => $ctr1\"" . $typeline . "\"$ctr2,
    	'type'  => " . strtoupper($type) . ",
    	'flavorText'  => $ctr1'" . str_replace("'", "\'", $flavor) . "'$ctr2,
      'artist' => \"" . $artist . "\",
			'extension'=>'ROC',
  ");


    if ($subtype != '') {
      fwrite($fp, " 'subtypes'  => [" . str_replace(" ", ",", strtoupper($subtype)) . "],\n");
    }
    if ($effect != '') {
      fwrite($fp, " 				'effectDesc' => $ctr1'" . addslashes($effect) . "'$ctr2,\n");
    }
    if ($echo != '') {
      fwrite($fp, " 				'supportDesc' => $ctr1'" . addslashes($echo) . "'$ctr2,\n");
      if (str_contains($echo, '{I}')) {
        fwrite($fp, " 			     'supportIcon' => 'infinity',\n");
      } else {
        fwrite($fp, " 			     'supportIcon' => 'discard',\n");
      }
    }
    if ($forest != '') {
      fwrite($fp, "     'forest' => $forest, \n");
    }
    if ($mountain != '') {
      fwrite($fp, "     'mountain' => $mountain, \n");
    }
    if ($water != '') {
      fwrite($fp, "     'ocean' => $water, \n");
    }
    if ($cost != '') {
      fwrite($fp, "     'costHand' => $cost, \n");
    }
    if ($costMemory != '') {
      fwrite($fp, "     'costReserve' => $costMemory, \n");
    }
    if (!empty($changedStats)) {
      fwrite($fp, "     'changedStats' => ['" . join("','", $changedStats) . "'], \n");
    }
    if ($effect != '') {
      if (str_contains($effect, "SCOUT")) {
        fwrite($fp, " 		'scout' => 99,\n");
      }
      if (str_contains($effect, '<COOLDOWN>')) {
        fwrite($fp, " 		'cooldown' => true,\n");
      }
      if (str_contains($effect, '<SEASONED>')) {
        fwrite($fp, " 		'seasoned' => true,\n");
      }
      if (str_contains($effect, '<GIGANTIC>')) {
        fwrite($fp, " 		'gigantic' => true,\n");
      }
      if (str_contains($effect, '<RUSH>')) {
        fwrite($fp, " 		'rush' => 'todo',\n");
      }
      if (str_contains($effect, '<TOUGH_1>')) {
        fwrite($fp, " 		'tough'=>1,\n");
      }
    }



    fwrite($fp, "];
  }
}
");


    fclose($fp);
  }
  fclose($handle);
}
