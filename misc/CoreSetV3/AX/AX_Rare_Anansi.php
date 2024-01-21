<?php
namespace ALT\Cards\AX;

class AX_Rare_Anansi extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_13_R2',
      'asset' => 'ALT_CORE_B_LY_13_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Anansi',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'flavorText' =>
        'In the end, he had accumulated pretty well all the wisdom that was available. He put it in a gourd and made a stopper for it.',
      'artist' => 'Taras Susak',
      'subtypes' => [ARTIST],
      'effectDesc' => '{J} I gain 1 boost$[BB] for each card in your Reserve.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
    ];
  }
}
