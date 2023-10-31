<?php
namespace ALT\Cards\AX;

class AX_Common_SierraOddball extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '1',
      'asset' => 'AX-02-Sierra-Oddball-Rgb', // MISSING
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Sierra & Oddball'),
      'typeline' => clienttranslate('Axiom Hero'),
      'rarity' => RARITY_COMMON,
      'type' => HERO,
      'subtype' => '',

      'effectDesc' => clienttranslate(
        'When you play a Permanent, you may exhaust me ({T}) to create a [2/2/2 Brassbug] Robot token.'
      ),
    ];
  }
}
