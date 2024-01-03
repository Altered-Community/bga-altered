<?php
namespace ALT\Cards\MU;

class MU_Common_RinOrchid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_03_C',
      'asset' => 'ALT_CORE_B_MU_03_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Rin & Orchid'),
      'typeline' => clienttranslate('Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'When one of your Expeditions moves forward due to {V} — Draw a card, then put a card from your hand in Reserve.'
      ),
    ];
  }
}
