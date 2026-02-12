<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_NyalaNightReveler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_90_R1',
      'asset'  => 'ALT_DUSTER_B_LY_90_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Nyala, Night Reveler"),
      'typeline' => clienttranslate("Character - Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I can get in anywhere, VIP list or not."'),
      'artist' => "DOBA",
      'extension' => 'SDU',
      'subtypes'  => [MAGE],
      'effectDesc' => clienttranslate('{H} If I\'m <IN_CONTACT>, you may exchange a card from your Reserve with a card from your hand.'),
      'supportDesc' => clienttranslate('#{D} : Exchange another card from your Reserve with a card from your hand.#'),
      'supportIcon' => 'discard',
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['mountain'],
      'effectHand' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isInContact', 'effect' =>  FT::ACTION(EXCHANGE, ['targetType' => [PERMANENT, SPELL, CHARACTER]], ['optional' => true]),]),
      'effectSupport' => FT::ACTION(EXCHANGE, ['targetType' => [PERMANENT, SPELL, CHARACTER]])
    ];
  }
}
