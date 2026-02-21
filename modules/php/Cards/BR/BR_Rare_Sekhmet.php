<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Sekhmet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_113_R1',
      'asset'  => 'ALT_EOLE_B_BR_113_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Sekhmet"),
      'typeline' => clienttranslate("Character - Deity"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
      'extension' => 'ROC',
      'subtypes'  => [DEITY],
      'effectDesc' => clienttranslate('{H} You may return target Character facing me with Base Cost #{2} or less# to its owner\'s hand.  {R} I gain 2 boosts.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 3,
      //VTO
      'costReserve' => 4,
      'changedStats' => ['costHand'],
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'maxBaseCost' => 2,
        'upTo' => true,
        'effect' => FT::RETURN_TO_HAND(),
      ]),
      'effectReserve' => FT::GAIN(ME, BOOST, 2),
    ];
  }
}
