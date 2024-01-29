<?php
namespace ALT\Cards\OD;

class OD_Rare_PaperHerald extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_04_R1',
      'asset' => 'ALT_CORE_B_OR_04_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Paper Herald',
      'typeline' => 'Character - Messenger',
      'type' => CHARACTER,
      'flavorText' => 'Words mean more than what is set down on paper.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [MESSENGER],
      'supportDesc' =>
        '{D} : Create an <ORDIS_RECRUIT> Soldier token in target Expedition. (Discard me from Reserve to do this.)',
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 2,
      'costHand' => 1,
      'costReserve' => 1,
      'changedStats' => ['mountain', 'ocean'],
    ];
  }
}
