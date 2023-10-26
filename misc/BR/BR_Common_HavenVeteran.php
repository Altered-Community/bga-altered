<?php
namespace ALT\Cards\BR;

class BR_Common_HavenVeteran extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '52',
      'asset' => 'BR-30_SeiringarOldGuard_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Haven Veteran'),
      'type' => CHARACTER,
      'subtype' => 'Blademaster',
      'typeline' => 'Common - Blademaster',
      'rarity' => RARITY_COMMON,

      'forest' => 4,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
