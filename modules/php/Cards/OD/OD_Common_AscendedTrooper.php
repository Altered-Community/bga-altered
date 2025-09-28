<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_AscendedTrooper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_67_C',
      'asset'  => 'ALT_CYCLONE_B_OR_67_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Ascended Trooper"),
      'typeline' => clienttranslate("Character - Soldier"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('After months of expeditions, Aedyt felt she had finally spread her wings.'),
      'artist' => "Jefrey Yonathan",
      'extension' => 'SO',
      'subtypes'  => [SOLDIER],
      'effectDesc' => clienttranslate('{H} If I\'m in an Ascended Expedition, I gain 1 boost. Otherwise, my Expedition <ASCENDS>. (Until Rest, it can move forward even if matched in its region\'s terrains by the opponent\'s Expedition.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::XOR(
        FT::ACTION(CHECK_CONDITION, [
          'condition' => 'isCardExpeditionAscended',
          'effect' => FT::GAIN(ME, BOOST),
          'oppositeEffect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend', 'expedition' => 'source'])
        ]),
      )
    ];
  }
}
