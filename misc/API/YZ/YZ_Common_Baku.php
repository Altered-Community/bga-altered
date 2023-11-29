<?php
namespace ALT\Cards\YZ;

class YZ_Common_Baku extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_10_C',
      'asset' => 'ALT_CORE_B_YZ_10_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Baku'),
      'typeline' => clienttranslate('Character - Spirit'),
      'type' => CHARACTER,
      'subtypes' => [SPIRIT],
      'effectDesc' => clienttranslate('{M} Target opponent discards a card from their hand.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
