<?php
namespace ALT\Cards\OD;

class OD_Common_TeamworkTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_24_C',
      'asset' => 'ALT_CORE_B_OR_24_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Teamwork Training'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Send to Reserve target Character with Hand Cost {X} or less, where X is the number of Characters you control.'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
