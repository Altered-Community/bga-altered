<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_ALTNurture extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_27_R1',
      'asset' => 'ALT_CORE_B_MU_27_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT Nurture'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('Up to two target Characters gain #2# boosts.  '),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::ACTION(TARGET, ['upTo' => true, 'n' => 2, 'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),
    ];
  }
}
