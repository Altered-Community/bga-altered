<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_TheBeastofGevaudan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_MU_114_R1',
      'asset'  => 'ALT_EOLE_B_MU_114_R',
      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Beast of Gévaudan"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"When the wolf is at the door, the sheep are in danger."'),
      'artist' => "Victor Canton",
      'extension' => 'ROC',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{H} You may target another Character with {V} less than or equal to mine. It switches Expeditions.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['ocean', 'costHand'],
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'excludeSelf' => true,
        'compareTargetBiome' => ['biome' => FOREST, 'op' => 'lte', 'source' => 'source'],
        'effect' => FT::ACTION(MOVE_CARD, []),
      ],['optional' => true]),
    ];
  }
}
