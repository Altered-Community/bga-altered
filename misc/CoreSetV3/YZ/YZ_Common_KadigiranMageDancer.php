<?php
namespace ALT\Cards\YZ;

class YZ_Common_KadigiranMageDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_07_C',
      'asset' => 'ALT_CORE_B_YZ_07_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Kadigiran Mage-Dancer',
      'typeline' => 'Character - Mage Soldier',
      'type' => CHARACTER,
      'flavorText' => '"Don\'t just wait for magic to happen. Go out and make your own!"',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [MAGE, SOLDIER],
      'effectDesc' => 'When you play a Spell — I gain 1 boost$<BB>.',
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 1,
    ];
  }
}
