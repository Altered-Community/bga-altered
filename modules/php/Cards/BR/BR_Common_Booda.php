<?php
namespace ALT\Cards\BR;

class BR_Common_Booda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '67',
      'asset' => 'BR-31-Booda-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Booda'),
      'typeline' => clienttranslate('Common - Token - Cat'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Token - Cat',

      'effectDesc' => clienttranslate(
        '[Token].  (At the beginning of the game, remove me from your deck. When I leave the Expedition Zone - Remove me from the game).'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'token' => true,
      'costHand' => '',
      'costReserve' => '',
    ];
  }
}
