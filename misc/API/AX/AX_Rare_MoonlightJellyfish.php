<?php
namespace ALT\Cards\AX;

class AX_Rare_MoonlightJellyfish extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_05_R2',
      'asset' => 'ALT_CORE_B_YZ_05_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Moonlight Jellyfish'),
      'typeline' => clienttranslate('Character - Spirit'),
      'type' => CHARACTER,
      'subtypes' => [SPIRIT],
      'effectDesc' => clienttranslate(
        'When a Robot joins your Expeditions — You may sacrifice me to give it 2 boost[]s. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)  When I\'m sacrificed, if I\'m not [[Fleeting]] — Send me to Reserve.'
      ),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
