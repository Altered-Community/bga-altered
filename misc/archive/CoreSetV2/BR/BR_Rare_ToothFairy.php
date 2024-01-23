<?php
namespace ALT\Cards\BR;

class BR_Rare_ToothFairy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_06_R2',
      'asset' => 'ALT_CORE_B_YZ_06_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Tooth Fairy'),
      'typeline' => clienttranslate('Character - Fairy'),
      'type' => CHARACTER,
      'subtypes' => [FAIRY],
      'effectDesc' => clienttranslate('{H} $[SABOTAGE].'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
