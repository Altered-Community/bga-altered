<?php
namespace ALT\Cards\AX;

class AX_Rare_JianAssemblyOverseer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '29',
      'asset' => 'Z-SLUSH_AX-29_JianLam_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Jian, Assembly Overseer'),
      'type' => CHARACTER,
      'subtype' => 'Engineer',
      'typeline' => 'Rare - Engineer',
      'rarity' => RARITY_RARE,

      'echoDesc' => clienttranslate(
        '<{D} : The next Permanent you play this turn costs {1} less.> (Discard me from your Reserve to activate this effect)'
      ),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
