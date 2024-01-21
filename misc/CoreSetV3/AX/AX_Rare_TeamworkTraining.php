<?php
namespace ALT\Cards\AX;

class AX_Rare_TeamworkTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_24_R2',
      'asset' => 'ALT_CORE_B_OR_24_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
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
