<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_TheHare extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_75_R1',
      'asset'  => 'ALT_CYCLONE_B_BR_75_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Hare"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Move your feet, lose your seat!"'),
      'artist' => "DOBA",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{H} If you are first player, target player becomes first player.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costReserve'],
      'effectHand' => fT::ACTION(CHECK_CONDITION, [
        'condition' => 'isFirstPlayer',
        'effect' =>
        FT::ACTION(TARGET_PLAYER, [
          'opponentsOnly' => false,
          'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'switchPlayer'])
        ])
      ])
    ];
  }
}
