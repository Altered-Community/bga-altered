<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_MunaDruid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '112',
      'asset' => 'MU-13-TasakaalMeshrider-C',
      'frameSize' => 0,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Muna Druid'),
      'type' => CHARACTER,
      'subtype' => 'Druid',
      'typeline' => clienttranslate('Common - Druid'),
      'rarity' => RARITY_COMMON,

      'echoDesc' => clienttranslate(
        '{D} : Target Character with hand cost {3} or less becomes [[Anchored]]. (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectEcho' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}
