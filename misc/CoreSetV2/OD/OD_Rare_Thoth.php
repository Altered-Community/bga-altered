<?php
namespace ALT\Cards\OD;

class OD_Rare_Thoth extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_22_R1',
      'asset' => 'ALT_CORE_B_OR_22_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Thoth'),
      'typeline' => clienttranslate('Character - Bureaucrat Deity'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT, DEITY],
      'effectDesc' => clienttranslate(
        'When my Expedition fails to move forward during Dusk — Create #two# [ORDIS_RECRUIT] Soldier tokens in target Expedition.'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
