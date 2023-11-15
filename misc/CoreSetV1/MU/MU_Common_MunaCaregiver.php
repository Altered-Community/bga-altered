<?php
namespace ALT\Cards\MU;

class MU_Common_MunaCaregiver extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_04_C',
      'asset' => 'ALT_CORE_B_MU_04_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Muna Caregiver'),
      'type' => CHARACTER,
      'subtype' => DRUID,
      'supportDesc' => clienttranslate(
        '{D} : Target Character with hand cost {3} or less becomes [ANCHORED]. (Discard me from your Reserve to activate this effect)  '
      ),
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}
