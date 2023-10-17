<?php
namespace ALT\Cards\BR;

class BR_Rare_SkilledTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_BR_2_2_14',
      'asset' => 'BR-24_AltrunTracer_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Skilled Tracer'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'typeline' => 'Explorer Rare - Adventurer',
      'rarity' => RARITY_RARE,
      'effectDesc' => clienttranslate('{J} [[Fleeting]].'),

      'reminders' => clienttranslate('Fleeting: If I would be sent to Reserve, banish me instead.'),
      'forest' => 4,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 2,
      'costMemory' => 2,
      'effectHand' => [[FLEETING => 1]],
      'effectMemory' => [[FLEETING => 1]],
    ];
  }
}
