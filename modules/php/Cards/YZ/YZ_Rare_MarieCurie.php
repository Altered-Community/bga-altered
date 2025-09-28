<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_MarieCurie extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_73_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_73_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Marie Curie"),
      'typeline' => clienttranslate("Character - Scientist"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"It is important to make a dream of life and of a dream reality."'),
      'artist' => "Taras Susak",
      'extension' => 'SO',
      'subtypes'  => [SCIENTIST],
      'effectDesc' => clienttranslate('#{H} You may sacrifice a Character or Permanent. If you don\'t, I gain <FLEETING>.#'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand'],
      'effectHand' => FT::XOR(
        FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [PERMANENT, CHARACTER],
          'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
        ]),
        FT::GAIN(ME, FLEETING)
      )
    ];
  }
}
