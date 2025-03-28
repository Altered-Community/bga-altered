<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Bugfix extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_AX_58_C',
      'asset'  => 'ALT_BISE_B_AX_58_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Bugfix"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('It\'s not Kelon, but this Sap will make you feel better, I swear.'),
      'artist' => "Kevin Sidharta",
      'extension' => 'WFTM',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('<COOLDOWN>. (If I go to Reserve after my effect resolves, exhaust me {T}. Exhausted cards can\'t be played and have no Support abilities.)  You may spend 1 counter from a card you control or in your Reserve to create a <BRASSBUG> Robot token in target Expedition.'),
      'costHand' => 1,
      'costReserve' => 2,
      'cooldown' => true,
      'effectPlayed' => FT::ACTION(
        TARGET,
        [
          'targetLocation' => CONTROLLED_RESERVE,
          'targetPlayer' => ME,
          'augmentOnly' => true,
          'targetType' => TYPES,
          'upTo' => true,
          'effect' => FT::ACTION(SPEND, [
            'cardId' => ME,
            'effect' => FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'AX_Common_Brassbug',
              'targetLocation' => STORMS,
            ])
          ])
        ]
      ),
    ];
  }
}
