<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_SneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '127',
      'asset' => 'MU-08-Sneezer-Shroom-R',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Sneezer Shroom'),
      'typeline' => clienttranslate('Rare - Plant'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Plant',

      'effectDesc' => clienttranslate('{J} I become [[Anchored]].  [G]At Dawn - I gain 1 boost.[/G]'),
      'reminders' => clienttranslate(
        '(Anchored: At Night, I don\'t go to Reserve and I lose Anchored. Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
      'effectPassive' => ['Dawn' => ['condition' => 'myTurn', 'output' => FT::GAIN($this, BOOST)]],
    ];
  }
}
