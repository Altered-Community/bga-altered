<?php
namespace ALT\Cards\OD;

class OD_Common_Issitoq extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_19_C',
      'asset' => 'ALT_CORE_B_OR_19_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Issitoq'),
      'typeline' => clienttranslate('Character - Bureaucrat'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => clienttranslate('Your other Expedition and the Expedition facing it can\'t move forward.'),
      'supportDesc' => clienttranslate('{D} : Draw a card. (Discard me from Reserve to do this.)'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
