<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_OrdisGatekeeper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_13_R2',
      'asset' => 'ALT_CORE_B_OR_13_R',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ordis Gatekeeper'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        'The Aegis Sentinel opened the door and stepped aside to let her through, acknowledging her with a nod as she passed.'
      ),
      'artist' => 'Atanas Lozanski',
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('{J} #Target Character# in your other Expedition #gains 2 boosts#.'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetLocation' => ['oppositeSource'],
        'targetPlayer' => ME,
        'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2]),
      ]),
    ];
  }
}
