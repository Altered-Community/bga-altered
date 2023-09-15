<?php
namespace ALT\Cards\MU;

class MU_Base_MunaDruid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-20_TasakaalMeshrider_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Muna Druid');
    $this->type = EXPLORER;
    $this->subtype = 'Druid';
    $this->rarity = RARITY_BASE;
    $this->forest = 3;
    $this->mountain = 2;
    $this->water = 2;
    $this->costHand = 3;
    $this->costMemory = 3;
  }
}
