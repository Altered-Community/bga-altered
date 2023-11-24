<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

// TO CHECK
class YZ_Common_AkeshaTaru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_01_C',
      'asset' => 'ALT_CORE_B_YZ_01_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Akesha & Taru'),
      'type' => HERO,
      'effectDesc' => clienttranslate('{1}, {T} : $[AFTER_YOU]. This ability is free if you have the first player token.  '),
    ];
  }
}

// class YZ_Common_AkeshaTaru extends \ALT\Models\Card
// {
//   public function __construct($row)
//   {
//     parent::__construct($row);

//     $this->properties = [
//       'uid' => '165',
//       'asset' => 'YZ-01-Akesha-Kone',
//       'frameSize' => 1,

//       'faction' => FACTION_YZ,
//       'name' => clienttranslate('Akesha & Taru'),
//       'typeline' => clienttranslate('Yzmir Hero'),
//       'rarity' => RARITY_COMMON,
//       'type' => HERO,
//       'subtype' => '',

//       'reserveSlots' => 2,
//       'permanentSlots' => 2,

//       'effectDesc' => clienttranslate('{2}, {T} : [After you]. This ability costs {2} less if you have the first player Token'),
//       'effectTap' => FT::ACTION(AFTER_YOU, ['pay' => 2, 'condition' => 'notFirstPlayer']),
//     ];
//   }
// }
