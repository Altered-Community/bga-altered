<?php
namespace ALT\Cards\YZ;

class YZ_Common_LadyoftheLake extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '166',
      'asset' => 'YZ-09-Nimue-C',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Lady of the Lake'),
      'typeline' => clienttranslate('Common - Spirit'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Spirit',

      'forest' => 1,
      'mountain' => 1,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
