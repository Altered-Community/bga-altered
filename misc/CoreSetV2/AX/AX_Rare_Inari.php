<?php
namespace ALT\Cards\AX;

class AX_Rare_Inari extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_11_R2',
      'asset' => 'ALT_CORE_B_MU_11_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Inari'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'supportDesc' => clienttranslate(
        '#{D} : Activate the {j} triggers of target Permanent you control.# (Discard me from Reserve to do this.)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['mountain'],
    ];
  }
}
