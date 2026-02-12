<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_PartialReferee extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_93_C',
      'asset'  => 'ALT_DUSTER_B_YZ_93_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Partial Referee"),
      'typeline' => clienttranslate("Character - Bureaucrat Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Red card! Out!"'),
      'artist' => "Abigael Giroud",
      'extension' => 'SDU',
      'subtypes'  => [BUREAUCRAT, ROGUE],
      'effectDesc' => clienttranslate('{H} Discard target Character. If its Base Cost was {3} or more, its controller draws a card. (Its Base Cost is the Reserve Cost if Fleeting, or the Hand Cost if not.)'),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 3,
      'effectHand' => FT::XOR(
        FT::ACTION(TARGET, [
          'minBaseCost' => 3,
          'effect' => FT::SEQ(
            FT::ACTION(DISCARD, []),
            FT::ACTION(DRAW, ['players' => 'owner'])
          )
        ]),
        FT::ACTION(TARGET, [
          'maxBaseCost' => 2,
          'effect' => FT::ACTION(DISCARD, []),
        ]),

      )
    ];
  }
}
