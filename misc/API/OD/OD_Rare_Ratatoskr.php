<?php
namespace ALT\Cards\OD;

class OD_Rare_Ratatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_04_R2',
      'asset' => 'ALT_CORE_B_BR_04_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ratatoskr'),
      'typeline' => clienttranslate('Character - Messenger'),
      'type' => CHARACTER,
      'subtypes' => [MESSENGER],
      'effectDesc' => clienttranslate('{R} Create two [Ordis Recruit 1/1/1] Soldier tokens in my Expedition.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
