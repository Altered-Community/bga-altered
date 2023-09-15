<?php
namespace ALT\Cards\MU;

class MU_Base_ConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-43_ConiferalConeman_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Coniferal Coneman');
    $this->type = EXPLORER;
    $this->subtype = 'Plant';
    $this->rarity = RARITY_BASE;
    $this->forest = 3;
    $this->mountain = 3;
    $this->water = 3;
    $this->costHand = 5;
    $this->costMemory = 5;
  }
}
