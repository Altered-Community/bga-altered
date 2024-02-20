<?php
namespace ALT\Cards\OD;

class OD_Common_RobinHood extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_21_C',
      'asset' => 'ALT_CORE_B_OR_21_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Robin Hood',
      'typeline' => 'Character - Bureaucrat',
      'type' => CHARACTER,
      'flavorText' => 'Justice comes from a fair redistribution of wealth.',
      'artist' => 'Taras Susak',
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => 'Characters your opponents play cost {1} more.',
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
