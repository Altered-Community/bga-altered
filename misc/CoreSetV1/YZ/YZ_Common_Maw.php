<?php
namespace ALT\Cards\YZ;

class YZ_Common_Maw extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_31_C',
      'asset' => 'ALT_CORE_B_YZ_31_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Maw'),
      'type' => TOKEN,
      'subtype' => VOID_WURM,
      'effectDesc' => clienttranslate(
        'I am a token.  (When I leave the Expedition zone — Discard me)  Whenever you sacrifice a Character, I gain 2 boosts.  '
      ),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
    ];
  }
}
