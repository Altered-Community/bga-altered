<?php
namespace ALT\Cards\BR;

class BR_Rare_Aja extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_17_R2',
      'asset' => 'ALT_CORE_B_MU_17_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Aja',
      'typeline' => 'Character - Deity',
      'type' => CHARACTER,
      'flavorText' =>
        'She is the soul of the forest, the patron of herbal medicine. From herbs and roots, she mixes potent potions.',
      'artist' => 'Rémi Jacquot',
      'subtypes' => [DEITY],
      'effectDesc' => '{H} Each player puts the top card of their deck in their Mana zone (as an exhausted Mana Orb).',
      'forest' => 4,
      'mountain' => 5,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
