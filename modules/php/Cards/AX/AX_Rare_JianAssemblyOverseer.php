<?php
namespace ALT\Cards\AX;

class AX_Rare_JianAssemblyOverseer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '29',
      'asset' => 'AX-10-JianLam-R',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Jian, Assembly Overseer'),
      'typeline' => clienttranslate('Rare - Engineer'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Engineer',

      'echoDesc' => clienttranslate(
        '[G]{D} : The next Permanent you play this turn costs {1} less.[/G] (Discard me from your Reserve to activate this effect)'
      ),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
