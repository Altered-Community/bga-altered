<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_SpyCraft extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_22_C',
      'asset' => 'ALT_CORE_B_YZ_22_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Spy Craft'),
      'type' => SPELL,
      'subtype' => DISRUPTION,
      'effectDesc' => clienttranslate('$[FLEETING].  $[SABOTAGE], $[RESUPPLY].'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
        FT::ACTION(RESUPPLY, [])
      ),
    ];
  }
}
