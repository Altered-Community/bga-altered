<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_DemolitionExpert extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_67_C',
      'asset'  => 'ALT_CYCLONE_B_AX_67_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Demolition Expert"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Mining aerolith is dangerous, but it\'s well worth the risk.'),
      'artist' => "Victor Canton",
      'extension' => 'SO',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('{H} Create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")  {R} You may sacrifice a Permanent.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => [
        'action' => INVOKE_TOKEN,
        'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
      ],
      'effectReserve' => FT::ACTION(
        TARGET,
        [
          'targetPlayer' => ME,
          'targetType' => [PERMANENT],
          'upTo' => true,
          'effect' =>
          FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
        ]
      )
    ];
  }
}
