<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_SagittaSoaringLeviathan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_74_C',
      'asset'  => 'ALT_CYCLONE_B_OR_74_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Sagitta, Soaring Leviathan"),
      'typeline' => clienttranslate("Character - Leviathan"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('We flew higher to escape the turbulence of its wings.'),
      'artist' => "Ba Vo",
      'extension' => 'SO',
      'subtypes'  => [LEVIATHAN],
      'effectDesc' => clienttranslate('I cost {1} less for each of your Ascended Expeditions.  $<GIGANTIC>.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 6,
      'costReserve' => 6,
      'gigantic' => true,
      'dynamicCostReduction' => 'eachOwnerAscended'
    ];
  }
}
