<?php
namespace ALT\Cards\OD;

class OD_Common_TeamworkTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_24_C',
      'asset' => 'ALT_CORE_B_OR_24_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Teamwork Training',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'Through their Hive Mind, Ordis turns the thoughts of the multitude into a unified will.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [DISRUPTION],
      'effectDesc' =>
        '$[FLEETING].  Send to Reserve target Character with Hand Cost {X} or less, where X is the number of Characters you control.',
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
