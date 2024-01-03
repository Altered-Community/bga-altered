<?php
namespace ALT\Cards\AX;

class AX_Rare_Coppelia extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_14_R1',
      'asset' => 'ALT_CORE_B_AX_14_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Coppélia'),
      'typeline' => clienttranslate('Character - Robot'),
      'type' => CHARACTER,
      'subtypes' => [ROBOT],
      'effectDesc' => clienttranslate('When I go to Reserve from your hand — You may play me for free and I gain $[ASLEEP].'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain'],
    ];
  }
}
