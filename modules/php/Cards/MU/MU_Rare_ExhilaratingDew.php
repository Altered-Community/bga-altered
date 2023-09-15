<?php
namespace ALT\Cards\MU;

class MU_Rare_ExhilaratingDew extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-49_Nurturing_Watering_Can_RGB_02';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Exhilarating Dew');
    $this->type = SPELL;
    $this->subtype = '';
    $this->rarity = RARITY_RARE;
    $this->costHand = 2;
    $this->costMemory = 2;
  }
}
