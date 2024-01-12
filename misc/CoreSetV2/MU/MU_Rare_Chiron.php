<?php
namespace ALT\Cards\MU;

class MU_Rare_Chiron extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_11_R2',
      'asset' => 'ALT_CORE_B_BR_11_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Chiron'),
      'typeline' => clienttranslate('Character - Trainer'),
      'type' => CHARACTER,
      'subtypes' => [TRAINER],
      'effectDesc' => clienttranslate('{J} #Up to two target Characters each# gain 1 boost$[BB].'),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['mountain', 'ocean'],
    ];
  }
}
