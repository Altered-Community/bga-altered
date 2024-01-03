<?php
namespace ALT\Cards\OD;

class OD_Rare_TheKraken extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_17_R2',
      'asset' => 'ALT_CORE_B_YZ_17_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Kraken'),
      'typeline' => clienttranslate('Character - Leviathan'),
      'type' => CHARACTER,
      'subtypes' => [LEVIATHAN],
      'effectDesc' => clienttranslate(
        '[Gigantic]. (I am considered present in each of your Expeditions.)  {J} Sacrifice two Characters.  All regions are {E} and lose their other types.'
      ),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 8,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}
