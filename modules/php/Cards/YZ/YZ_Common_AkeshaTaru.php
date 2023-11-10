<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_AkeshaTaru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '165',
      'asset' => 'YZ-01-Akesha-Kone',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Akesha & Taru'),
      'typeline' => clienttranslate('Yzmir Hero'),
      'rarity' => RARITY_COMMON,
      'type' => HERO,
      'subtype' => '',

      'memorySlots' => 2,
      'permanentSlots' => 2,

      'effectDesc' => clienttranslate('{2}, {T} : [After you]. This ability costs {2} less if you have the first player Token'),
      'effectTap' => FT::ACTION(AFTER_YOU, ['pay' => 2, 'condition' => 'notFirstPlayer']),
    ];
  }
}
