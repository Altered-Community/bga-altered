<?php
namespace ALT\Cards\OD;

class OD_Common_Thoth extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_22_C',
      'asset' => 'ALT_CORE_B_OR_22_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Thoth',
      'typeline' => 'Character - Bureaucrat Deity',
      'type' => CHARACTER,
      'flavorText' => '"The pen is mightier than the sword."',
      'artist' => 'Christophe Young',
      'subtypes' => [BUREAUCRAT, DEITY],
      'effectDesc' =>
        'When my Expedition fails to move forward during Dusk — Create an [ORDIS_RECRUIT] Soldier token in target Expedition after Rest.',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
