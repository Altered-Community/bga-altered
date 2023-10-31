<?php
namespace ALT\Cards\AX;

class AX_Common_Brassbug extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '32',
      'asset' => 'AX-31-Brassbug-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Brassbug'),
      'typeline' => clienttranslate('Common - Token - Robot'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Token - Robot',

      'effectDesc' => clienttranslate(
        '[Token].  (At the beginning of the game, remove me from your deck. When I leave the Expedition Zone - Remove me from the game).'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
    ];
  }
}
