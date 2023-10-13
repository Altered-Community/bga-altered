<?php
namespace ALT\Cards\MU;

class MU_Base_TeijaandNauraa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_MU_1_1_17',
      'asset' => 'MU-02_Teija-Nauraa_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Teija and Nauraa'),
      'type' => ALTERATEUR,
      'subtype' => 'Muna Hero',
      'typeline' => 'Muna Hero',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('The first Character you play each day gains 1 [Boost].'),

      'reminders' => clienttranslate(
        'Boosts are +1/+1/+1 counters. Remove them when the boosted Character leaves the Expedition Zone.'
      ),
      'memorySlots' => 2,
      'permanentSlots' => 2,
    ];
  }
}
