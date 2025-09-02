<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_OutofaClearSky extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_77_R1',
      'asset'  => 'ALT_CYCLONE_B_OR_77_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Out of a Clear Sky"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('A swarm of messages bursts forth in a rustling of paper.'),
      'artist' => "Zero Wen",
      'extension' => 'SO',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  I cost #{1} less for each# of your Ascended Expeditions.  Send target Character to Reserve.'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, ['effect' => FT::DISCARD_TO_RESERVE()])
      ),
      'dynamicCostReduction' => 'eachwOwnerAscended'
    ];
  }
}
