<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisTrooper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '129',
      'asset' => 'OD-05-AegisCadet-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Ordis Trooper'),
      'typeline' => clienttranslate('Common - Soldier'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Soldier',

      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}
