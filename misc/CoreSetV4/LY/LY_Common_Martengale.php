<?php
namespace ALT\Cards\LY;

class LY_Common_Martengale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_04_C',
      'asset' => 'ALT_CORE_B_LY_04_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'Martengale',
      'typeline' => 'Character - Spirit Animal',
      'type' => CHARACTER,
      'flavorText' => 'Spotting a martengale is always a good omen.',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [SPIRIT, ANIMAL],
      'supportDesc' => '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)',
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
