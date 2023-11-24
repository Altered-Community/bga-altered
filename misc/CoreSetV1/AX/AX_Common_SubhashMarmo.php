<?php
namespace ALT\Cards\AX;

class AX_Common_SubhashMarmo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_03_C',
      'asset' => 'ALT_CORE_B_AX_03_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Subhash & Marmo'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'At Dawn — You may pay {1} and put a card from your hand in Reserve to create a [BRASSBUG] Robot token.'
      ),
    ];
  }
}
