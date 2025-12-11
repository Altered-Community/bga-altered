<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_SouvenirSeller extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_87_C',
      'asset'  => 'ALT_DUSTER_B_OR_87_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Souvenir Seller"),
      'typeline' => clienttranslate("Character - Merchant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Souvenirs are memories incarnate. Treasure them."'),
      'artist' => "Zero Wen",
      'extension' => 'SDU',
      'subtypes'  => [MERCHANT],
      'effectDesc' => clienttranslate('{J} You may give me 1 boost. If you do, target opponent <RESUPPLIES>.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ_OPTIONAL(
        FT::GAIN(ME, BOOST),
        FT::ACTION(RESUPPLY, ['player' => 'nextPlayer'])
      )
    ];
  }
}
