<?php
namespace ALT\Cards\AX;

class AX_Rare_FoundryArmorer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_16_R1',
      'asset' => 'ALT_CORE_B_AX_16_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Foundry Armorer'),
      'typeline' => clienttranslate('Character - Engineer'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'flavorText' => clienttranslate('No Brassbug would survive in the Tumult without their armor.'),
      'effectDesc' => clienttranslate('{J} Create a [Brassbug 2/2/2] Robot token in target Expedition.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
