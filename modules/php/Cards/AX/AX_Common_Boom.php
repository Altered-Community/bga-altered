<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Boom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_21_C',
      'asset' => 'ALT_CORE_B_AX_21_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Boom!',
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$[FLEETING].  Sacrifice a Character. If you do, discard target Character or Permanent.',
      'flavorText' => "\"Catastrophic failure? I prefer the term 'learning opportunity'.\"",
      'typeline' => 'Spell - Disruption',
      'artist' => 'HuoMiao Studio',

      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [CHARACTER, TOKEN],
          'effect' => FT::SEQ(
            FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
            FT::ACTION(TARGET, [
              'targetType' => [CHARACTER, TOKEN, PERMANENT],
              'effect' => FT::ACTION(DISCARD, []),
            ])
          ),
        ])
      ),
    ];
  }
}
