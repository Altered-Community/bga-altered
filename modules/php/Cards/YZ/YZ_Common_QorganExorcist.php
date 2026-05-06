<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;
use ALT\Models\Card;

class YZ_Common_QorganExorcist extends Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_YZ_112_C',
      'asset' => 'ALT_EOLE_B_YZ_112_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Qorgan Exorcist'),
      'typeline' => clienttranslate('Character - Mage'),
      'type' => CHARACTER,
      'subtypes' => [MAGE],
      'effectDesc' => clienttranslate('{H} Discard the top card of your deck.'),
      'flavorText' => clienttranslate("Now we just need to cover Sam's back."),
      'artist' => 'Nestor Papatriantafyllou',
      'extension' => 'ROC',

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(DISCARD_FROM_DECK, ['players' => ME, 'n' => 1]),
    ];
  }
}
