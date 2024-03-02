<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_GiftofSelf extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_20_R2',
      'asset' => 'ALT_CORE_B_YZ_20_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Gift of Self',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' =>
      'Her being begins to disintegrate as she breaks all the Mana bridges linking the idea of who she is to physical matter.',
      'artist' => 'Fahmi Fauzi',
      'subtypes' => [CONJURATION],
      'effectDesc' => '$<FLEETING>.  Sacrifice a Character. If you do, draw two cards.',
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::SEQ_OPTIONAL(
          FT::ACTION(
            TARGET,
            [
              'targetPlayer' => ME,
              'targetType' => [CHARACTER, TOKEN],
              'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice'])
            ]
          ),
          FT::ACTION(DRAW, ['players' => ME, 'n' => 2])
        )
      )
    ];
  }
}
