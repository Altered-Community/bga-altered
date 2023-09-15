<?php
namespace ALT\Cards\MU;

class MU_Base_SneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-36_Sneezer_Shroom_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Sneezer Shroom');
    $this->type = EXPLORER;
    $this->subtype = 'Plant';
    $this->rarity = RARITY_BASE;
    $this->forest = 1;
    $this->mountain = 1;
    $this->water = 1;
    $this->costHand = 2;
    $this->costMemory = 2;
  }
}
