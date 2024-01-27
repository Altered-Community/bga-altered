<?php
namespace ALT\Cards\YZ;

class YZ_Rare_MonolithArchivist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_10_R2',
      'asset' => 'ALT_CORE_B_OR_10_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Monolith Archivist'),
      'typeline' => clienttranslate('Character - Bureaucrat'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('"The form has been filled out incorrectly. Please make a new appointment tomorrow."'),
      'artist' => 'Atanas Lozanski',
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => clienttranslate('$[DEFENDER].'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
