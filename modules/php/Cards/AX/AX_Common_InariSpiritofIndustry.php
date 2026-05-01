<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_InariSpiritofIndustry extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_115_C',
      'asset'  => 'ALT_EOLE_B_AX_115_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Inari, Spirit of Industry"),
      'typeline' => clienttranslate("Character - Deity Robot"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Julien Carrasco",
      'extension' => 'ROC',
      'subtypes'  => [DEITY, ROBOT],
      'effectDesc' => clienttranslate('When you pass — If your hand is empty, draw a card.'),
      'forest' => 4,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'effectPassive' => [
        'EndTurn' => [
          [
            'conditions' => ['isMe', 'isHandEmpty'],
            'output' => FT::ACTION(DRAW, ['players' => ME]),
          ],
        ],
      ],
    ];
  }
}
