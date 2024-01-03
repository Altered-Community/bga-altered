<?php
namespace ALT\Cards\OD;

class OD_Rare_MonolithLegate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_08_R1',
      'asset' => 'ALT_CORE_B_OR_08_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Monolith Legate'),
      'typeline' => clienttranslate('Character - Bureaucrat'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => clienttranslate(
        'When my Expedition fails to move forward during Dusk — [Sabotage] after Rest. (Discard up to one target card from a Reserve.)'
      ),
      'supportDesc' => clienttranslate(
        '{D} : Create an [Ordis Recruit 1/1/1] Soldier token in target Expedition. (Discard me from Reserve to do this.)'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
