<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_Talos extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_96_C',
      'asset'  => 'ALT_DUSTER_B_OR_96_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Talos"),
      'typeline' => clienttranslate("Character - Robot"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('It was Talos\'s role to protect the statue from prying eyes.'),
      'artist' => "Taras Susak",
      'extension' => 'SDU',
      'subtypes'  => [ROBOT],
      'effectDesc' => clienttranslate('$<GIGANTIC>.  <DEFENDER>. (My Expeditions can\'t move forward during Dusk.)'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 5,
      'costReserve' => 5,
      'gigantic' => true,
      'defender' => true
    ];
  }
}
