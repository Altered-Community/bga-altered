<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Exalted_PlagueofArrogance extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_116_E',
      'asset'  => 'ALT_EOLE_B_BR_116_E',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_EXALTED,
      'name'  => clienttranslate("Plague of Arrogance"),
      'typeline' => clienttranslate("Character - Corruption"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Taras Susak",
      'extension' => 'ROC',
      'subtypes'  => [CORRUPTION],
      'effectDesc' => clienttranslate('<GIGANTIC>.  {J} Sacrifice a Feat to choose one, or sacrifice a <COMPLETED_LOW> Feat to choose two:  • <SABOTAGE>.  • Send target Character to Reserve.  • I gain 2 boosts.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 3,
      'costHand' => 7,
      'costReserve' => 7,
      'gigantic' => true,
    ];
  }
}
