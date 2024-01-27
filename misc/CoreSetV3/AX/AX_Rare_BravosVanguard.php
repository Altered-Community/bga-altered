<?php
namespace ALT\Cards\AX;

class AX_Rare_BravosVanguard extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_14_R2',
      'asset' => 'ALT_CORE_B_BR_14_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Bravos Vanguard',
      'typeline' => 'Character - Adventurer',
      'type' => CHARACTER,
      'flavorText' =>
        '"We will be the arrow that pierces the veil of the unknown, the torch that banishes the mists of ignorance!"',
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [ADVENTURER],
      'effectDesc' => '{J} You may have another target Character lose [FLEETING_CHAR] #and gain 1 boost#.',
      'forest' => 4,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
