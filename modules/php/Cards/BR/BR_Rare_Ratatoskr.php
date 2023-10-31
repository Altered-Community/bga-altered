<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_Ratatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '66',
      'asset' => 'BR-04-Ratatoskr-02',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Ratatoskr'),
      'typeline' => clienttranslate('Rare - Squirrel'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Squirrel',

      'effectDesc' => clienttranslate('{S} I gain [G]3[/G] boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
      'effectMemory' => FT::GAIN($this, BOOST, 3),
    ];
  }
}
