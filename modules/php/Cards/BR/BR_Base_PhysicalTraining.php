<?php
namespace ALT\Cards\BR;

class BR_Base_PhysicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR-17_GerichtVanBraast_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Physical Training'),
      'type' => SPELL,
      'subtype' => '',
      'rarity' => RARITY_BASE,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
