<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_RidersMask extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_102_R1',
      'asset'  => 'ALT_DUSTER_B_BR_102_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Rider's Mask"),
      'typeline' => clienttranslate("Expedition Permanent - Gear"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('An essential accessory for any Leviathan rider.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SDU',
      'subtypes'  => [GEAR, EXPEDITION],
      'effectDesc' => clienttranslate('#<BOOSTED_CHA_P> Characters in my Expedition are <TOUGH_CHA_P_1>.# (Opponents must pay {1} to target them.)  {T}, #{X}# : The next Character that joins my Expedition this turn gains #X boosts.#'),
      'costHand' => 1,
      'costReserve' => 1,
      'expeditionTough' => 'boosted',
      'effectTap' => FT::SEQ(
        FT::ACTION(PAY, ['pay' => 'X']),
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharactInExpeditionBoost', 'args' => ['X' => 'paidMana']])
      )
    ];
  }
}
