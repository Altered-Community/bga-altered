<?php
namespace ALT\Cards\YZ;

class YZ_Rare_TheKraken extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_17_R1',
      'asset' => 'ALT_CORE_B_YZ_17_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Kraken'),
      'typeline' => clienttranslate('Character - Leviathan'),
      'type' => CHARACTER,
      'subtypes' => [LEVIATHAN],
      'effectDesc' => clienttranslate(
        '[Gigantic].  {J} Sacrifice one Character.  All regions are {E} and lose their other types. (I am considered present in each of your Expeditions.)'
      ),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 8,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}
