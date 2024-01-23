<?php
namespace ALT\Cards\OD;

class OD_Rare_TeamworkTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_24_R1',
      'asset' => 'ALT_CORE_B_OR_24_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Teamwork Training'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$[FLEETING].  #Create an [ORDIS_RECRUIT] Soldier token in target Expedition.#  Send to Reserve target Character with Hand Cost {X} or less, where X is the number of Characters you control.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}
