<?php
namespace ALT\Cards\AX;

class AX_Common_Melantho extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_FUGUE_B_AX_134_C',
      'asset' => 'ALT_FUGUE_B_AX_134_C',
      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Melantho'),
      'typeline' => clienttranslate('Character'),
      'flavorText'  => clienttranslate('\"Do and undo...This must end.\"'),
      'artist' => 'Zaeliven',
      'extension' => 'NEJ',
      'type' => CHARACTER,
      'effectDesc' => clienttranslate('{R} $<SABOTAGE>. (Discard up to one target card from a Reserve.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 0,
      'effectReserve' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
    ];
  }
}
