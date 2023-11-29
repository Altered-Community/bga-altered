<?php
namespace ALT\Cards\OD;

class OD_Common_MonolithLegate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_08_C',
      'asset' => 'ALT_CORE_B_OR_08_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Monolith Legate'),
      'typeline' => clienttranslate('Character - Bureaucrat'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => clienttranslate(
        'When my Expedition fails to move forward during Dusk — [Sabotage] after Rest. (Discard up to one target card from a Reserve.)'
      ),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
