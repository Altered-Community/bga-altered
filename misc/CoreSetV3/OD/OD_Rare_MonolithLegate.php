<?php
namespace ALT\Cards\OD;

class OD_Rare_MonolithLegate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_08_R1',
      'asset' => 'ALT_CORE_B_OR_08_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Monolith Legate',
      'typeline' => 'Character - Bureaucrat',
      'type' => CHARACTER,
      'flavorText' => 'Your document has expired. Needless to say, that\'s not his problem.',
      'artist' => 'Romain Kurdi',
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => 'When my Expedition fails to move forward during Dusk — $[SABOTAGE] after Rest.',
      'supportDesc' =>
        '#{D} : Create an [ORDIS_RECRUIT] Soldier token in target Expedition.# (Discard me from Reserve to do this.)',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['mountain'],
    ];
  }
}
