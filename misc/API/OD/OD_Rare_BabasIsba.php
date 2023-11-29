<?php
namespace ALT\Cards\OD;

class OD_Rare_BabasIsba extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_28_R2',
      'asset' => 'ALT_CORE_B_YZ_28_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate("Baba's Isba"),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} Draw a card.  {T}, Sacrifice a Character: [After You]. (End your turn as if you had played a card. You may still play cards later this Day.)'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
