<?php
namespace ALT\Cards\YZ;

class YZ_Common_TheKraken extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_17_C',
      'asset' => 'ALT_CORE_B_YZ_17_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'The Kraken',
      'typeline' => 'Character - Leviathan',
      'type' => CHARACTER,
      'flavorText' =>
        'The Kraken tears open the surface, sending plumes of water crashing down on the troops in an apocalyptic deluge.',
      'artist' => 'Fahmi Fauzi',
      'subtypes' => [LEVIATHAN],
      'effectDesc' => '$[GIGANTIC].  {J} Sacrifice two Characters.  All regions are {E} and lose their other types.',
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 8,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}
