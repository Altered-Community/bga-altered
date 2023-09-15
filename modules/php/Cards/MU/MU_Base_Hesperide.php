<?php
namespace ALT\Cards\MU;

class MU_Base_Hesperide extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-42_Hesperide_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Hesperide');
    $this->type = EXPLORER;
    $this->subtype = 'Plant';
    $this->rarity = RARITY_BASE;
    $this->forest = 3;
    $this->mountain = 5;
    $this->water = 5;
    $this->costHand = 3;
    $this->costMemory = 3;
  }
}
