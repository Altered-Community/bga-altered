<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_HavenBouncer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '49',
      'asset' => 'BR-15-MiskiCalderon-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Haven Bouncer'),
      'typeline' => clienttranslate('Common - Adventurer'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Adventurer',

      'effectDesc' => clienttranslate('{M} [Sabotage].'),
      'reminders' => clienttranslate('(Sabotage: Banish up to one target card from a Reserve.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(TARGET, ['targetLocation' => [RESERVE], 'upTo' => true, 'effect' => FT::ACTION(DISCARD, [])]),
    ];
  }
}
