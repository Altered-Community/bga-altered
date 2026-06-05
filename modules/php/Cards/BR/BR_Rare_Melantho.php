<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_Melantho extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_FUGUE_B_AX_134_R2',
      'asset' => 'ALT_FUGUE_B_AX_134_R',
      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Melantho'),
      'typeline' => clienttranslate('Character'),
      'flavorText'  => clienttranslate('\"Do and undo...This must end.\"'),
      'artist' => 'Zaeliven',
      'extension' => 'NEJ',
      'type' => CHARACTER,
      'effectDesc' => clienttranslate('{R} $<SABOTAGE>, then I gain 1 boost.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 0,
      'effectReserve' => FT::SEQ(
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
        FT::GAIN(ME, BOOST),
      ),
    ];
  }
}
