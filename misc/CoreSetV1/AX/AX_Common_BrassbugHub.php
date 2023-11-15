<?php
namespace ALT\Cards\AX;

class AX_Common_BrassbugHub extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_24_C',
      'asset' => 'ALT_CORE_B_AX_24_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Brassbug Hub'),
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate(
        '{J} I gain 3 Kelon counters.  At Dawn — You may pay {1} and remove a Kelon counter from me to create a [BRASSBUG] Robot token.  '
      ),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
