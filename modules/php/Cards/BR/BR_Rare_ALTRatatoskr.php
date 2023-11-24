<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_ALTRatatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_04_R1',
      'asset' => 'ALT_CORE_B_BR_04_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT Ratatoskr'),
      'type' => CHARACTER,
      'subtype' => SQUIRREL,
      'effectDesc' => clienttranslate('{S} I gain #3# boosts.  '),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
      'effectReserve' => FT::GAIN($this, BOOST, 3),
    ];
  }
}
