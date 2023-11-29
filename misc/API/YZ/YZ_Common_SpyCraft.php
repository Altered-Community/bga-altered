<?php
namespace ALT\Cards\YZ;

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
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  [Sabotage], [Resupply]. (Send me to Discard instead of Reserve after my effect resolves.Discard up to one target card from a Reserve.Put the top card of your deck in your Reserve.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
