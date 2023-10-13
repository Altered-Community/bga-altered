<?php
namespace ALT\Cards\BR;

class BR_Base_BravosBouncer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_BR_2_1_9',
      'asset' => 'BR-30_SeiringarOldGuard_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Bouncer'),
      'type' => EXPLORER,
      'subtype' => 'Blademaster',
      'typeline' => 'Explorer Base - Blademaster',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate(''),

      'forest' => 4,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
