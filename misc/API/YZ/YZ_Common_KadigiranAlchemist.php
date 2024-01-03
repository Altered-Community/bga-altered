<?php
namespace ALT\Cards\YZ;

class YZ_Common_KadigiranAlchemist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_12_C',
      'asset' => 'ALT_CORE_B_YZ_12_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kadigiran Alchemist'),
      'typeline' => clienttranslate('Character - Mage'),
      'type' => CHARACTER,
      'subtypes' => [MAGE],
      'effectDesc' => clienttranslate(
        '{H} I gain 2 boost[]s. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 1,
    ];
  }
}
