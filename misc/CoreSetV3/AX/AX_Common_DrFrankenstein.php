<?php
namespace ALT\Cards\AX;

class AX_Common_DrFrankenstein extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_17_C',
      'asset' => 'ALT_CORE_B_AX_17_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Dr. Frankenstein',
      'typeline' => 'Character - Engineer',
      'type' => CHARACTER,
      'flavorText' => 'We sometimes seek companionship in the strangest of life forms.',
      'artist' => 'Taras Susak',
      'subtypes' => [ENGINEER],
      'effectDesc' => '{R} You may activate the {j} triggers of target Permanent you control.',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 3,
    ];
  }
}
