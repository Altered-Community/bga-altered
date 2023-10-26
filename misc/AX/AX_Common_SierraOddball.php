<?php
namespace ALT\Cards\AX;

class AX_Common_SierraOddball extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '1',
      'asset' => 'AX-02_Sierra-Oddball_Rgb',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Sierra & Oddball'),
      'type' => HERO,
      'subtype' => 'Axiom Hero',
      'typeline' => '',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate(
        'When you play a Permanent, you may exhaust me ({T}) to create a [2/2/2 Brassbug] Robot token.'
      ),
    ];
  }
}
