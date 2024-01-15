<?php
namespace ALT\Cards\AX;

class AX_Rare_Martengale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_04_R2',
      'asset' => 'ALT_CORE_B_LY_04_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Martengale'),
      'typeline' => clienttranslate('Character - ANIMAL'),
      'type' => CHARACTER,
      'subtypes' => [ANIMAL],
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
