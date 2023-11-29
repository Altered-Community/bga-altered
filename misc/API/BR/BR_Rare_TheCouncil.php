<?php
namespace ALT\Cards\BR;

class BR_Rare_TheCouncil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_12_R2',
      'asset' => 'ALT_CORE_B_OR_12_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Council'),
      'typeline' => clienttranslate('Character - Bureaucrat'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => clienttranslate('The {J}, {M} and {S} triggers of Characters facing me don\'t activate.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
