<?php
namespace ALT\Cards\MU;

class MU_Base_Kitsune extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-09_Kitsune_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Kitsune');
    $this->type = EXPLORER;
    $this->subtype = 'Spirit';
    $this->rarity = RARITY_BASE;
    $this->forest = 1;
    $this->mountain = 1;
    $this->water = 1;
    $this->costHand = 1;
    $this->costMemory = 1;
  }
}
