<?php
namespace ALT\Cards\BR;

class BR_Rare_FoundryArmorer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_16_R2',
      'asset' => 'ALT_CORE_B_AX_16_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Foundry Armorer'),
      'typeline' => clienttranslate('Character - Engineer'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'flavorText' => clienttranslate('No Brassbug would survive in the Tumult without their armor.'),
      'effectDesc' => clienttranslate('{R} Create a [Brassbug 2/2/2] Robot token in target Expedition.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
