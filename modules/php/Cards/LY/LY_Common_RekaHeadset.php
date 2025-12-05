<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_RekaHeadset extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_101_C',
      'asset'  => 'ALT_DUSTER_B_LY_101_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Headset"),
      'typeline' => clienttranslate("Expedition Permanent - Gear"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('This way, we\'re all on the same wavelength.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SDU',
      'subtypes'  => [GEAR, EXPEDITION],
      'effectDesc' => clienttranslate('My Expedition and its Characters are considered <IN_CONTACT>. (Even if there are no other Expeditions in my region.)  {T} : The next Character that joins my Expedition this turn gains 1 boost.'),
      'costHand' => 1,
      'costReserve' => 2,
      'overrideContact' => true,
      'effectTap' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharactInExpeditionBoost', 'args' => ['n' => 1]])
    ];
  }
}
