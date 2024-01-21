<?php
namespace ALT\Cards\BR;

class BR_Rare_BravosTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_07_R1',
      'asset' => 'ALT_CORE_B_BR_07_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Bravos Tracer'),
      'typeline' => clienttranslate('Character - Adventurer'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate("\"I only feel alive when I hear the wind whistling in my ears.\""),
      'artist' => 'Justice Wong',
      'subtypes' => [ADVENTURER],
      'effectDesc' => clienttranslate('{J} I gain [FLEETING_CHAR]. (If I would be sent to Reserve, discard me instead.)'),
      'forest' => 4,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'ocean'],
    ];
  }
}
