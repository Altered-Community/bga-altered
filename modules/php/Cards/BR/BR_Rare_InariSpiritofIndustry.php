<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_InariSpiritofIndustry extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_115_R2',
      'asset'  => 'ALT_EOLE_B_AX_115_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Inari, Spirit of Industry"),
      'typeline' => clienttranslate("Character - Deity Robot"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Julien Carrasco",
      'extension' => 'ROC',
      'subtypes'  => [DEITY, ROBOT],
      'effectDesc' => clienttranslate('When you pass — If your hand is empty, draw a card. #Otherwise, <RESUPPLY_LOW>.#'),
      'forest' => 4,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 3,
      'changedStats' => ['costReserve'],
    ];
  }
}
