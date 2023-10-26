<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisSpy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '140',
      'asset' => 'Z-SLUSH_OR-24_EskheretRuunKurush_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('Ordis Spy'),
      'type' => CHARACTER,
      'subtype' => 'Citizen',
      'typeline' => 'Common - Citizen',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{M} [Sabotage].'),
      'reminders' => clienttranslate('(Sabotage: Banish up to one target card from a Reserve.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
