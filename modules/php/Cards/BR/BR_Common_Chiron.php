<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

// TO CHECK
class BR_Common_Chiron extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_11_C',
      'asset' => 'ALT_CORE_B_BR_11_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Chiron'),
      'type' => CHARACTER,
      'subtype' => TRAINER,
      'effectDesc' => clienttranslate('{J} Target Character gains 1 boost.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST])]),
      'effectReserve' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),
    ];
  }
}

// class BR_Common_Chiron extends \ALT\Models\Card
// {
//   public function __construct($row)
//   {
//     parent::__construct($row);

//     $this->properties = [
//       'uid' => '44',
//       'asset' => 'BR-11-Chiron-C',
//       'frameSize' => 1,

//       'faction' => FACTION_BR,
//       'name' => clienttranslate('Chiron'),
//       'typeline' => clienttranslate('Common - Trainer'),
//       'rarity' => RARITY_COMMON,
//       'type' => CHARACTER,
//       'subtype' => 'Trainer',

//       'effectDesc' => clienttranslate('{M} Target Character gains 1 boost.  {S} Target Character gains 2 boosts.'),
//       'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
//       'forest' => 1,
//       'mountain' => 1,
//       'ocean' => 1,
//       'costHand' => 2,
//       'costReserve' => 2,
//       'effectHand' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST])]),
//       'effectReserve' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),
//     ];
//   }
// }
