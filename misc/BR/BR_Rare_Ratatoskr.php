<?php
namespace ALT\Cards\BR;

class BR_Rare_Ratatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '66',
      'asset' => 'BR-38_Ratatoskr_02',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Ratatoskr'),
      'type' => CHARACTER,
      'subtype' => 'Squirrel',
      'typeline' => 'Rare - Squirrel',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('{S} I gain <3> boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}
