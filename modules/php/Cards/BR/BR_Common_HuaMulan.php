<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

// TO CHECK
class BR_Common_HuaMulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_12_C',
      'asset' => 'ALT_CORE_B_BR_12_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Hua Mulan'),
      'type' => CHARACTER,
      'subtype' => ADVENTURER,
      'effectDesc' => clienttranslate('{S} I lose [FLEETING_CHAR].  '),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

// class BR_Common_HuaMulan extends \ALT\Models\Card
// {
//   public function __construct($row)
//   {
//     parent::__construct($row);

//     $this->properties = [
//       'uid' => '47',
//       'asset' => 'BR-12-Hua-Mulan-C',
//       'frameSize' => 1,

//       'faction' => FACTION_BR,
//       'name' => clienttranslate('Hua Mulan'),
//       'typeline' => clienttranslate('Common - Adventurer'),
//       'rarity' => RARITY_COMMON,
//       'type' => CHARACTER,
//       'subtype' => 'Adventurer',

//       'effectDesc' => clienttranslate('{S} I gain 2 boosts.'),
//       'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
//       'forest' => 2,
//       'mountain' => 4,
//       'ocean' => 2,
//       'costHand' => 3,
//       'costReserve' => 3,
//       'effectReserve' => FT::GAIN($this, BOOST, 2),
//     ];
//   }
// }
