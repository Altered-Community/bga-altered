<?php
namespace ALT\Cards\BR;

class BR_Rare_BravosVanguard extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_14_R1',
      'asset' => 'ALT_CORE_B_BR_14_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Bravos Vanguard'),
      'typeline' => clienttranslate('Character - Adventurer'),
      'type' => CHARACTER,
      'subtypes' => [ADVENTURER],
      'effectDesc' => clienttranslate(
        '{J} You may have another target Character lose [FLEETING_CHAR] #and gain 1 boost#. (If it would be sent to Reserve, discard it instead.)'
      ),
      'forest' => 4,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
