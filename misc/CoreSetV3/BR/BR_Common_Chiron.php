<?php
namespace ALT\Cards\BR;

class BR_Common_Chiron extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_11_C',
      'asset' => 'ALT_CORE_B_BR_11_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Chiron',
      'typeline' => 'Character - Trainer',
      'type' => CHARACTER,
      'flavorText' => "\"And now, pray, mark all these things well in a wise heart.\"",
      'artist' => 'Justice Wong',
      'subtypes' => [TRAINER],
      'effectDesc' => '{J} Target Character gains 1 boost$[BB].',
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
