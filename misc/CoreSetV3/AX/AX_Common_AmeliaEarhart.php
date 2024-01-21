<?php
namespace ALT\Cards\AX;

class AX_Common_AmeliaEarhart extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_11_C',
      'asset' => 'ALT_CORE_B_AX_11_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Amelia Earhart'),
      'typeline' => clienttranslate('Character - Adventurer'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate("\"The most effective way to do it, is to do it.\""),
      'artist' => 'Taras Susak',
      'subtypes' => [ADVENTURER],
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 1,
    ];
  }
}
