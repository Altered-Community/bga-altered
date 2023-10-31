<?php
namespace ALT\Cards\LY;

class LY_Common_OuroborosDealer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '83',
      'asset' => 'LY-C7-Kasirga-Dealer-C',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Ouroboros Dealer'),
      'typeline' => clienttranslate('Common - Citizen'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Citizen',

      'effectDesc' => clienttranslate('{M} Roll a dice, if the result is 4 or more, draw a card, otherwise, [Resupply].'),
      'reminders' => clienttranslate('(Resupply: Put the top card of your deck in your Reserve.)'),
      'forest' => 0,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}
