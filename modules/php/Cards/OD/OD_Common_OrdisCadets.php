<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;
class OD_Common_OrdisCadets extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '132',
      'asset' => 'OD-06-TrainingGrounds-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Ordis Cadets'),
      'typeline' => clienttranslate('Common - Soldier'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Soldier',

      'effectDesc' => clienttranslate('{J} Create a [1/1/1 Ordis Recruit] Soldier token in my Expedition.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 2,
      'costMemory' => 2,
      'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => $this->getPId(),
        'tokenType' => 'OD_Common_OrdisRecruit',
        'targetLocation' => ['source'],
      ]),
    ];
  }
}
