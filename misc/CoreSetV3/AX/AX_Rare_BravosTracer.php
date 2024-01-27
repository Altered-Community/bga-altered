<?php
namespace ALT\Cards\AX;

class AX_Rare_BravosTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_07_R2',
      'asset' => 'ALT_CORE_B_BR_07_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Bravos Tracer',
      'typeline' => 'Character - Adventurer',
      'type' => CHARACTER,
      'flavorText' => '"I only feel alive when I hear the wind whistling in my ears."',
      'artist' => 'Justice Wong',
      'subtypes' => [ADVENTURER],
      'effectDesc' => '{J} I gain [FLEETING_CHAR]. (If I would be sent to Reserve, discard me instead.)',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
