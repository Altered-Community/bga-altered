<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_OrdisSpy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '140',
      'asset' => 'OD-14-Eskheret-ruun-Kurush-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Ordis Spy'),
      'typeline' => clienttranslate('Common - Citizen'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Citizen',

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
