<?php
namespace ALT\Cards\AX;

class AX_Rare_LyraChronicler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_16_R2',
      'asset' => 'ALT_CORE_B_LY_16_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Lyra Chronicler'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'supportDesc' => clienttranslate(
        '{D} : [Resupply]. (Put the top card of your deck in Reserve. Discard me from Reserve to do this.)'
      ),
      'forest' => 4,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
