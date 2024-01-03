<?php
namespace ALT\Cards\OD;

class OD_Rare_Quetzalcoatl extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_18_R1',
      'asset' => 'ALT_CORE_B_OR_18_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Quetzalcoatl'),
      'typeline' => clienttranslate('Character - Bureaucrat Deity'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT, DEITY],
      'effectDesc' => clienttranslate(
        'When an opponent draws one or more cards or does [RESUPPLY] — Create an [ORDIS_RECRUIT] Soldier token in target Expedition.'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['forest', 'mountain', 'water', 'costHand', 'costReserve'],
    ];
  }
}
