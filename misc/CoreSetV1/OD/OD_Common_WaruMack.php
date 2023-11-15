<?php
namespace ALT\Cards\OD;

class OD_Common_WaruMack extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_02_C',
      'asset' => 'ALT_CORE_B_OR_02_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Waru & Mack'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'At Dawn, if you have a Bureaucrat in your Expeditions — Create a [ORDIS_RECRUIT] Soldier token.  Whenever you play a Bureaucrat — you may have it become $[ASLEEP].  '
      ),
    ];
  }
}
