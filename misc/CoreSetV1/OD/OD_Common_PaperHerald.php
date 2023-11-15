<?php
namespace ALT\Cards\OD;

class OD_Common_PaperHerald extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_04_C',
      'asset' => 'ALT_CORE_B_OR_04_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Paper Herald'),
      'type' => CHARACTER,
      'subtype' => INSECT,
      'supportDesc' => clienttranslate(
        '{D} : Create a [ORDIS_RECRUIT] Soldier token. (Discard me from your Reserve to activate this effect)  '
      ),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}
