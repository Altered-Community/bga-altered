<?php
namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_HavenTrainee extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => '45',
      'asset' => 'BR-33-HavenTrainee-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Haven Trainee'),
      'type' => CHARACTER,
      'typeline' => clienttranslate('Character - Trainer'),
      'rarity' => RARITY_COMMON,
      'subtype' => 'Trainer',
      'effectDesc' => clienttranslate('{S} I gain 2 boosts.'),

      'reminders' => clienttranslate(
        'Boosts are +1/+1/+1 counters. Remove them when the boosted Character leaves the Expedition Zone.'
      ),
      'forest' => 3,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 4,
      'effectMemory' => FT::GAIN($this, BOOST, 2),
    ];
  }
}
