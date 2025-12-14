<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_FailedDemo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_97_C',
      'asset'  => 'ALT_DUSTER_B_AX_97_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Failed Demo"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Not a failure; just another step towards success.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SDU',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  Exhaust ({T}) a card in your Reserve. If you do, send to Reserve target Character with Base Cost {3} or less. (Reserve Cost if it\'s Fleeting, or Hand Cost if not.)'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetLocation' => [RESERVE],
          'targetType' => [CHARACTER, PERMANENT, SPELL],
          'effect' => FT::SEQ(
            FT::ACTION(EXHAUST, []),
            FT::ACTION(TARGET, [
              'targetType' => [CHARACTER],
              'maxBaseCost' => 3,
              'effect' => FT::DISCARD_TO_RESERVE()
            ])
          )
        ])
      )
    ];
  }
}
