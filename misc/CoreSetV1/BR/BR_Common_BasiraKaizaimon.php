<?php
namespace ALT\Cards\BR;

class BR_Common_BasiraKaizaimon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_03_C',
      'asset' => 'ALT_CORE_B_BR_03_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Basira & Kaizaimon'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'Whenever one of your Characters is boosted — You may exhaust me ({T}) to give any target Character 1 boost.'
      ),
    ];
  }
}
