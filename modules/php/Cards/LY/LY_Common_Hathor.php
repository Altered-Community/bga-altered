<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_Hathor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '69',
      'asset' => 'LY-07-Hathor-C',
      'frameSize' => 3,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Hathor'),
      'typeline' => clienttranslate('Common - Divinity'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Divinity',

      'echoDesc' => clienttranslate(
        '{D} : Return another card from your Reserve to your hand. (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 3,
      'effectEcho' => FT::ACTION(TARGET, ['targetPlayer' => ME, 'targetLocation' => [RESERVE], 'effect' => FT::RETURN_TO_HAND()]),
    ];
  }
}
