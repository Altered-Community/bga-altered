<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_WildlifeMedic extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_MU_116_R2',
      'asset'  => 'ALT_EOLE_B_MU_116_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Wildlife Medic"),
      'typeline' => clienttranslate("Character - Druid"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Zaeliven",
      'extension' => 'ROC',
      'subtypes'  => [DRUID],
      'effectDesc' => clienttranslate('{H} <RESUPPLY>. If you put #a Character# in Reserve this way, it gains 1 boost.'),
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
    ];
  }
}
