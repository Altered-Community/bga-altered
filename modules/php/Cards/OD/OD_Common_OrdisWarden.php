<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_OrdisWarden extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_68_C',
      'asset'  => 'ALT_CYCLONE_B_OR_68_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Ordis Warden"),
      'typeline' => clienttranslate("Character - Bureaucrat"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('You can\'t beat the clink for catching forty winks.'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [BUREAUCRAT],
      'effectDesc' => clienttranslate('{H} I gain $<ASLEEP>.  At Noon — Target player puts a card from their hand in Reserve.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::GAIN(ME, ASLEEP),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isMe',
          'output' => FT::ACTION(
            TARGET_PLAYER,
            [
              'opponentsOnly' => false,
              'effect' => FT::ACTION(
                TARGET,
                [
                  'targetType' => [CHARACTER, SPELL, PERMANENT],
                  'targetPlayer' => ME,
                  'targetLocation' => [HAND],
                  'effect' => FT::DISCARD_TO_RESERVE(),
                ],
              )
            ]
          ),
        ],
      ],
    ];
  }
}
