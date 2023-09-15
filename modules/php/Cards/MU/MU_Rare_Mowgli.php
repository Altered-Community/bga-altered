<?php
namespace ALT\Cards\MU;

class MU_Rare_Mowgli extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-14_Mowgli_RGB_02';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Mowgli');
    $this->type = EXPLORER;
    $this->subtype = 'Ranger';
    $this->rarity = RARITY_RARE;
    $this->forest = 2;
    $this->mountain = 2;
    $this->water = 2;
    $this->costHand = 2;
    $this->costMemory = 2;
  }
}
