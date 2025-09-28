<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_Daikokuten extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_76_R2',
      'asset'  => 'ALT_CYCLONE_B_LY_76_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Daikokuten"),
      'typeline' => clienttranslate("Character - Deity"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('If you never take a risk, you\'ll never be rewarded.'),
      'artist' => "Zero Wen",
      'extension' => 'SO',
      'subtypes'  => [DEITY],
      'effectDesc' => clienttranslate('{J} Target opponent may immediately play a #card with Base Cost {4} or more# for free. (Reserve Cost if from Reserve, Hand Cost otherwise.)'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['ocean'],
      'effectPlayed' => FT::ACTION(TARGET_PLAYER, ['effect' => FT::ACTION(CHOOSE_ASSIGNMENT, ['actions' => ['play'], 'minBaseCost' => 4, 'free' => true], ['optional' => true])])
    ];
  }
}
