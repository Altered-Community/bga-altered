<?php
namespace ALT\Cards\AX;

class AX_Common_JianAssemblyOverseer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '7',
      'asset' => 'AX-10-JianLam-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Jian, Assembly Overseer'),
      'typeline' => clienttranslate('Common - Engineer'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Engineer',

      'effectDesc' => clienttranslate('{J} If you control at least 2 Permanents, I gain 1 boost.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
