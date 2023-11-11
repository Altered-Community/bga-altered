<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_TheHatter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '85',
      'asset' => 'LY-18-MadHatter-C',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('The Hatter'),
      'typeline' => clienttranslate('Character - Citizen'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Citizen',

      'echoDesc' => clienttranslate(
        '{D} : Target Character with hand cost {3} or less becomes [[Anchored]]. (Discard me from your Reserve to activate this effect)'
      ),
      'reminders' => clienttranslate('He can\'t swim.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 0,
      'costHand' => 4,
      'costReserve' => 5,
      'effectEcho' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}
