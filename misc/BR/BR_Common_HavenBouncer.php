<?php
namespace ALT\Cards\BR;

class BR_Common_HavenBouncer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '49',
      'asset' => 'BR-19_MiskiCalderon_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Haven Bouncer'),
      'type' => CHARACTER,
      'subtype' => 'Adventurer',
      'typeline' => 'Common - Adventurer',
      'rarity' => RARITY_COMMON,

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
