<?php
namespace ALT\Cards\MU;

class MU_Base_Inari extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-06_Inari_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Inari');
    $this->type = EXPLORER;
    $this->subtype = 'Divinity';
    $this->rarity = RARITY_BASE;
    $this->forest = 3;
    $this->mountain = 1;
    $this->water = 3;
    $this->costHand = 3;
    $this->costMemory = 3;
  }
}
