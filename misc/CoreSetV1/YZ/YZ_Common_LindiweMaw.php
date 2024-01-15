<?php
namespace ALT\Cards\YZ;

class YZ_Common_LindiweMaw extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_02_C',
      'asset' => 'ALT_CORE_B_YZ_02_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lindiwe & Maw'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'At Dawn — You can pay {1} to create a [MAW] Void Worm token in your Companion zone with "Whenever you sacrifice a Character — I gain 2 boosts".  This ability is free if you have the first player token.'
      ),
    ];
  }
}
