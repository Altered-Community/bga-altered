<?php
namespace ALT\Cards\OD;

class OD_Rare_KelonicGenerator extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_27_R2',
      'asset' => 'ALT_CORE_B_AX_27_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kelonic Generator'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('#{1}#, {T} : Draw a card.'),
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costHand', 'costReserve'],
      'flavorText' => clienttranslate(' "Suspira\'s mines will soon run dry. Your precious Kelon will run dry. "'),
    ];
  }
}
