<?php
namespace ALT\Cards\LY;

class LY_Rare_PaperHerald extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_04_R2',
      'asset' => 'ALT_CORE_B_OR_04_R2',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Paper Herald'),
      'typeline' => clienttranslate('Character - Messenger'),
      'type' => CHARACTER,
      'subtypes' => [MESSENGER],
      'supportDesc' => clienttranslate(
        '{D} : Create a [Ordis Recruit 1/1/1] Soldier token in target Expedition. (Discard me from Reserve to do this.)'
      ),
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
