<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_RekaMagnate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_93_R2',
      'asset'  => 'ALT_DUSTER_B_AX_93_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Magnate"),
      'typeline' => clienttranslate("Character - Bureaucrat"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"A disruptive smoothie to knock the competition off balance!"'),
      'artist' => "Nestor Papatriantafyllou",
      'extension' => 'SDU',
      'subtypes'  => [BUREAUCRAT],
      'effectDesc' => clienttranslate('{R} Choose one, #or exhaust a Permanent you control to choose both:#  • <SABOTAGE>.  • Create a <MANASEED> token in your Landmarks.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectReserve' => FT::XOR(
        FT::XOR(
          FT::SABOTAGE(),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Manaseed',
            'targetLocation' => [LANDMARK],
          ]),
          FT::SEQ(
            FT::ACTION(TARGET, [
              'targetType' => [PERMANENT],
              'targetPlayer' => ME,
              'effect' => FT::SEQ(
                FT::ACTION(EXHAUST, ['cardId' => EFFECT]),
                FT::PAR(
                  FT::SABOTAGE(),
                  FT::ACTION(INVOKE_TOKEN, [
                    'pId' => 'source',
                    'tokenType' => 'NE_Common_Manaseed',
                    'targetLocation' => [LANDMARK],
                  ]),
                )
              )
            ]),

          )
        )
      )
    ];
  }
}
