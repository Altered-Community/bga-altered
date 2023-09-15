<?php
namespace ALT\Cards\MU;

class MU_Base_MusubiHarvester extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU_06_MusubiHarvester_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Musubi Harvester');
    $this->type = EXPLORER;
    $this->subtype = 'Plant';
    $this->rarity = RARITY_BASE;
    $this->forest = 1;
    $this->mountain = 0;
    $this->water = 0;
    $this->costHand = 1;
    $this->costMemory = 1;
  }
}
