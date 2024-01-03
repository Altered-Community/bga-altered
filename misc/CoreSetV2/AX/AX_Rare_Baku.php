<?php
namespace ALT\Cards\AX;

class AX_Rare_Baku extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_10_R2',
      'asset' => 'ALT_CORE_B_YZ_10_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Baku'),
      'typeline' => clienttranslate('Character - Spirit'),
      'type' => CHARACTER,
      'subtypes' => [SPIRIT],
      'effectDesc' => clienttranslate('{H} Target opponent discards a card from their hand.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 2,
    ];
  }
}
