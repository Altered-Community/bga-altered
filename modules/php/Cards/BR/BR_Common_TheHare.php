<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_TheHare extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_75_C',
      'asset'  => 'ALT_CYCLONE_B_BR_75_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("The Hare"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Move your feet, lose your seat!"'),
      'artist' => "DOBA",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{H} If you are first player, target player becomes first player.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
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
