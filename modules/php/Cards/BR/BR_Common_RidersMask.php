<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_RidersMask extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_102_C',
      'asset'  => 'ALT_DUSTER_B_BR_102_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Rider's Mask"),
      'typeline' => clienttranslate("Expedition Permanent - Gear"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('An essential accessory for any Leviathan rider.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SDU',
      'subtypes'  => [GEAR, EXPEDITION],
      'effectDesc' => clienttranslate('{T}, {1} : The next Character that joins my Expedition this turn gains 2 boosts. (Characters joining when you pass still join this turn.)'),
      'costHand' => 1,
      'costReserve' => 1,
      'effectTap' => FT::SEQ(
        FT::ACTION(PAY, ['pay' => 1]),
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharactInExpeditionBoost', 'args' => ['n' => 2]])
      )
    ];
  }
}
