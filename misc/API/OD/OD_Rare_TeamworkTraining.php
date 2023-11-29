<?php
namespace ALT\Cards\OD;

class OD_Rare_TeamworkTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_24_R1',
      'asset' => 'ALT_CORE_B_OR_24_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Teamwork Training'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Create a [Ordis Recruit 1/1/1] Soldier token in target Expedition.  Send to Reserve target Character with Hand Cost {X} or less, where X is the number of Characters you control. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
