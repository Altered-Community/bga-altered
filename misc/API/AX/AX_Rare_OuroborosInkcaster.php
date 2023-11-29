<?php
namespace ALT\Cards\AX;

class AX_Rare_OuroborosInkcaster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_12_R2',
      'asset' => 'ALT_CORE_B_LY_12_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ouroboros Inkcaster'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate(
        'When I go to Reserve from the Expedition zone — You may return another card in your Reserve to your hand.'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
