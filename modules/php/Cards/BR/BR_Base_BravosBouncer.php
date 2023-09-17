<?php
namespace ALT\Cards\BR;

class BR_Base_BravosBouncer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR-30_SeiringarOldGuard_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Bouncer'),
      'type' => EXPLORER,
      'subtype' => 'Blademaster',
      'rarity' => RARITY_BASE,
      'forest' => 4,
      'mountain' => 2,
      'water' => 4,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
