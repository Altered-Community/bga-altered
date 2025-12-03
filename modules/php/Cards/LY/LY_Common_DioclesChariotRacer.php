<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_DioclesChariotRacer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_93_C',
      'asset'  => 'ALT_DUSTER_B_LY_93_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Diocles, Chariot Racer"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Hop in, it\'s a guaranteed five-star experience!"'),
      'artist' => "Damian Audino",
      'extension' => 'SDU',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('I can\'t be played in a starting region.  {J} My Expedition moves backwards one region.  When I leave the Expedition zone — My Expedition moves forward one region.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 3,
      'playLimitation' => 'nonStartingRegion',
      'effectPlayed' => FT::ACTION(MOVE_EXPEDITION, [
        'pId' => ME,
        'n' => -1,
        'expedition' => [EFFECT]
      ]),
      'effectPassive' => [
        'LeaveExpedition' => [
          'pId' => CONTROLLER,
          'output' =>  FT::ACTION(MOVE_EXPEDITION, [
            'pId' => ME,
            'n' => 1,
            'expedition' => ['fromEvent']
          ]),
        ]
      ]
    ];
  }
}
