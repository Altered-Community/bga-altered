<?php
namespace ALT\Cards\AX;

class AX_Rare_LyraChronicler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_16_R2',
      'asset' => 'ALT_CORE_B_LY_16_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Lyra Chronicler',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'flavorText' => 'Eidolon or human, we are all shaped by stories. They\'re the building blocks of our identity. ',
      'artist' => 'Taras Susak',
      'subtypes' => [ARTIST],
      'supportDesc' => '#{D} : <RESUPPLY>.# (Put the top card of your deck in Reserve. Discard me from Reserve to do this.)',
      'forest' => 4,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
