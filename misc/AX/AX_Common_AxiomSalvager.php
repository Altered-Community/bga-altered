<?php
namespace ALT\Cards\AX;

class AX_Common_AxiomSalvager extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '18',
      'asset' => 'AX-06_Foundry_Smelter_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Axiom Salvager'),
      'type' => CHARACTER,
      'subtype' => 'Engineer',
      'typeline' => 'Common - Engineer',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{S} [Resupply].'),
      'reminders' => clienttranslate('(Resupply: Put the top card of your deck in your Reserve.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}
