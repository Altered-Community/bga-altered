<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_ALTEsmeralda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '95',
      'asset' => 'LY-11-Esmeralda-R',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('ALT Esmeralda'),
      'typeline' => clienttranslate('Rare - Artist'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Artist',

      'effectDesc' => clienttranslate('[G]{J}[/G] [Resupply].'),
      'reminders' => clienttranslate('(Resupply: Put the top card of your deck in your Reserve.)'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(RESUPPLY, []),
    ];
  }
}
