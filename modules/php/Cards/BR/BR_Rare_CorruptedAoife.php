<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_CorruptedAoife extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_108_R1',
      'asset'  => 'ALT_EOLE_B_BR_108_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Corrupted Aoife"),
      'typeline' => clienttranslate("Character - Adventurer Corruption"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
      'extension' => 'ROC',
      'subtypes'  => [ADVENTURER, CORRUPTION],
      'effectDesc' => clienttranslate('#I can\'t be played# unless you control a Feat.  {R} You may target another Character. It loses <FLEETING> and gains 1 boost.'),
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costReserve'],
      'playLimitation' => 'controlFeat',
      'effectReserve' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'excludeSelf' => true,
        'upTo' => true,
        'effect' => FT::SEQ(FT::LOOSE(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST)),
      ]),
    ];
  }
}
