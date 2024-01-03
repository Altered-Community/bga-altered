<?php
namespace ALT\Cards\LY;

class LY_Rare_AmahleAsgarthanOutcast extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_19_R1',
      'asset' => 'ALT_CORE_B_LY_19_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Amahle, Asgarthan Outcast'),
      'typeline' => clienttranslate('Character - Scholar'),
      'type' => CHARACTER,
      'subtypes' => [SCHOLAR],
      'effectDesc' => clienttranslate('{J} You may discard any number of cards from your Reserve to draw that many cards.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
