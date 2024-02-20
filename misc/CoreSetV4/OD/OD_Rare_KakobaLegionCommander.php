<?php
namespace ALT\Cards\OD;

class OD_Rare_KakobaLegionCommander extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_15_R1',
      'asset' => 'ALT_CORE_B_OR_15_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kakoba, Legion Commander'),
      'typeline' => clienttranslate('Character - Soldier Noble'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('The general who became a scholar; the scholar who became a senator.'),
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [SOLDIER, NOBLE],
      'effectDesc' => clienttranslate(
        '{J} If you control three or more other Characters, I gain #3 boosts$<BB>#. (Cards in Reserve are not controlled.)'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
