<?php
namespace ALT\Cards\BR;

class BR_Common_HavenVeteran extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '52',
      'asset' => 'BR-17-SeiringarOldGuard-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Haven Veteran'),
      'typeline' => clienttranslate('Common - Blademaster'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Blademaster',

      'forest' => 4,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
