<?php
namespace ALT\Cards\AX;

class AX_Common_Brassbug extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_31_C',
      'asset' => 'ALT_CORE_B_AX_31_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Brassbug'),
      'type' => TOKEN,
      'subtype' => ROBOT,
      'effectDesc' => clienttranslate('I am a token.  (When I leave the Expedition zone — Discard me)  '),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
    ];
  }
}
