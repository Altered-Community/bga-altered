<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_StrengthinNumbers extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_FUGUE_B_OR_144_R1',
      'asset' => 'ALT_FUGUE_B_OR_144_R',
      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Strength in Numbers'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'artist' => 'Gamon Studio',
      'extension' => 'NEJ',
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate('$<FLEETING>.  Ttarget a Character with no statistic higher than the number of #Characters# in your Expeditions. Send it to Reserve.'),
      'costHand' => 2,
      'costReserve' => 2, 
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER],
          'maxStatistic' => 'charactersInExpeditions',
          'effect' => FT::ACTION(DISCARD_TO_RESERVE, []),
        ]),
      ),
    ];
  }
}
