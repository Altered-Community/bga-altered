<?php
namespace ALT\Cards\AX;

class AX_Rare_AxiomReprocessor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '31',
      'asset' => 'AX-45_Recycling_Mill_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Axiom Reprocessor'),
      'type' => PERMANENT,
      'subtype' => '',
      'typeline' => '',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('<{J} [Resupply].>  At Dawn � Activate my {J} effect.'),
      'reminders' => clienttranslate('(Fleeting: If I would be sent to Reserve, banish me instead.)'),
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}
