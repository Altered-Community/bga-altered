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
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'Whenever one of your Expeditions advances due to a {V} statistic — Draw a card then put a card in Reserve from your hand.'
      ),
    ];
  }
}
