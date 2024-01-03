<?php
namespace ALT\Cards\AX;

class AX_Common_SierraOddball extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_01_C',
      'asset' => 'ALT_CORE_B_AX_01_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sierra & Oddball'),
      'typeline' => clienttranslate('Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'When you play a Permanent with Hand Cost {3} or more — You may exhaust me ({T}) to create a [BRASSBUG] Robot token in target Expedition.'
      ),
    ];
  }
}
