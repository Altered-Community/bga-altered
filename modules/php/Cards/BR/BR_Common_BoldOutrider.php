<?php
namespace ALT\Cards\BR;

class BR_Common_BoldOutrider extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_112_C',
      'asset'  => 'ALT_EOLE_B_BR_112_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Bold Outrider"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I\'ve found a way! A gap just two klicks away, straight ahead!"'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'ROC',
      'subtypes'  => [ADVENTURER],
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
