<?php
namespace ALT\Cards\YZ;

class YZ_Rare_OrdisAttorney extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_16_R2',
      'asset' => 'ALT_CORE_B_OR_16_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Ordis Attorney',
      'typeline' => 'Character - Bureaucrat',
      'type' => CHARACTER,
      'flavorText' => 'Objection!',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => 'When my Expedition fails to move forward during Dusk — Draw a card.',
      'forest' => 2,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
