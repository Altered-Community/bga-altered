<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Nike extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_76_R1',
      'asset'  => 'ALT_CYCLONE_B_OR_76_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Nike"),
      'typeline' => clienttranslate("Character - Deity"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('When she spreads her wings, her victory shall resonate for all eternity.'),
      'artist' => "Aaron Ming",
      'extension' => 'SO',
      'subtypes'  => [DEITY],
      'effectDesc' => clienttranslate('#If my Expedition is Ascended,# I am $<ETERNAL_FS>.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costReserve' => 7,
      'changedStats' => ['forest', 'mountain', 'ocean'],
      'dynamicEternal' => '1:isCardExpeditionAscended'
    ];
  }
}
