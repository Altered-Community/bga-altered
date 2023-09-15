<?php
namespace ALT\Cards\MU;

class MU_Base_ArtificialDew extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-49_Nurturing_Watering_Can_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Artificial Dew');
    $this->type = SPELL;
    $this->subtype = '';
    $this->rarity = RARITY_BASE;
    $this->costHand = 2;
    $this->costMemory = 2;
  }
}
