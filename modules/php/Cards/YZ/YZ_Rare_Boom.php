<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_Boom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_21_R2',
      'asset' => 'ALT_CORE_B_AX_21_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Boom!',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => '"Catastrophic failure? I prefer the term \'learning opportunity\'."',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$<FLEETING>.  Sacrifice a Character. If you do, discard target Character or Permanent.',
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
