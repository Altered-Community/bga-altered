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
      'typeline' => clienttranslate('Character - Druid'),
      'type' => CHARACTER,
      'subtypes' => [DRUID],
      'supportDesc' => clienttranslate(
        '{D} : Target Character with Hand Cost {3} or less gains [ANCHORED]. (Discard me from Reserve to do this.)'
      ),
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
