<?php
namespace ALT\Cards\YZ;

class YZ_Common_MagicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_19_C',
      'asset' => 'ALT_CORE_B_YZ_19_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Magical Training',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' => 'Without practice, the gift of Alteration will come to nothing.',
      'artist' => 'MISSING ARTIST',
      'subtypes' => [CONJURATION],
      'effectDesc' => 'Draw a card.',
      'costHand' => 1,
      'costReserve' => 3,
    ];
  }
}
