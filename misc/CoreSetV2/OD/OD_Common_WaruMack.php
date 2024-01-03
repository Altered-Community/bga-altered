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
      'typeline' => clienttranslate('Ordis Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'At Noon, if you control a Bureaucrat — Create an [ORDIS_RECRUIT] Soldier token in target Expedition.  When you play a Bureaucrat — You may have it gain $[ASLEEP].'
      ),
    ];
  }
}
