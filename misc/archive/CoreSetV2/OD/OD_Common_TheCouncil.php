<?php
namespace ALT\Cards\OD;

class OD_Common_TheCouncil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_12_C',
      'asset' => 'ALT_CORE_B_OR_12_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Council'),
      'typeline' => clienttranslate('Character - Bureaucrat'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => clienttranslate('The {j}, {h} and {r} triggers of Characters facing me don\'t activate.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
