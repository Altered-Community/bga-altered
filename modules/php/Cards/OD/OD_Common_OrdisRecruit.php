<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisRecruit extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '162',
      'asset' => 'OD-31-AegisRecruit-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Ordis Recruit'),
      'typeline' => clienttranslate('Common - Token - Soldier'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Token - Soldier',

      'effectDesc' => clienttranslate(
        '[Token].  (At the beginning of the game, remove me from your deck. When I leave the Expedition Zone - Remove me from the game).'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'token' => true,
      'costReserve' => '',
      'costHand' => '',
    ];
  }
}
