<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_ShiramunTechMonk extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_111_R1',
      'asset'  => 'ALT_EOLE_B_AX_111_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Shiramun, Tech Monk"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Tristan Bideau",
      'extension' => 'ROC',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('{H} You may #discard a card from your Reserve# to <SABOTAGE_INF>.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand'],
      'effectHand' =>
      FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetPlayer' => ME,
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::SEQ(
          FT::ACTION(DISCARD, []),
          FT::SABOTAGE(),
        ),
      ]),
    ];
  }
}
