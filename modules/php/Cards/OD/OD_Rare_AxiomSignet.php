<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_AxiomSignet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_76_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_76_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Axiom Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Humanism and progress.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('#<FLEETING>.#  Choose #two:#  • Create a <BRASSBUG> Robot token in target Expedition.  • Target Permanent you control activates its {j} abilities.  • Discard target Permanent with Hand Cost {3} or less.'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' =>  FT::SEQ(
        FT::GAIN(ME, FLEETING),
        [
          'type' => NODE_OR,
          'args' => ['n' => 2],
          'pId' => 'source',
          'childs' => [
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'AX_Common_Brassbug',
              'targetLocation' => STORMS,
            ]),
            FT::ACTION(TARGET, [
              'targetType' => [PERMANENT],
              'targetPlayer' => ME,
              'hasEffects' => ['Played'],
              'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
            ]),
            FT::ACTION(TARGET, ['maxHandCost' => 3, 'targetType' => [PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),
          ]
        ]
      )
    ];
  }
}
