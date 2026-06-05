<?php

namespace ALT\Cards\AX;

class AX_Exalted_HephaestusGodoftheForge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_FUGUE_B_AX_138_E',
      'asset' => 'ALT_FUGUE_B_AX_138_E',
      'faction' => FACTION_AX,
      'rarity' => RARITY_EXALTED,
      'name' => clienttranslate('Hephaestus, God of the Forge'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('<TEMPLE> {2}. (You may play me for {2} as a Landmark Permanent - Construction with: "At Noon — You may send me to Reserve.") When you pass — You may pay {1} to draw a card.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 3,
      'costTemple' => 2,
      'effectPassive' => [
        'EndTurn' => [
          FT::SEQ_OPTIONAL_MANUAL(
            FT::ACTION(PAY, ['pay' => 1]),
            FT::ACTION(DRAW, ['players' => ME])
          ),
        ],
      ],
    ];
  }
}
