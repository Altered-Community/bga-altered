<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_Sekhmet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_113_C',
      'asset'  => 'ALT_EOLE_B_BR_113_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Sekhmet"),
      'typeline' => clienttranslate("Character - Deity"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
      'extension' => 'ROC',
      'subtypes'  => [DEITY],
      'effectDesc' => clienttranslate('{H} You may return target Character facing me with Base Cost {3} or less to its owner\'s hand. (Its Base Cost is the Reserve Cost if it\'s Fleeting, or the Hand Cost if not.)  {R} I gain 2 boosts.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 4,
      //VTO
      'costReserve' => 4,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'maxBaseCost' => 3,
        'upTo' => true,
        'effect' => FT::RETURN_TO_HAND(),
      ]),
      'effectReserve' => FT::GAIN(ME, BOOST, 2),
    ];
  }
}
