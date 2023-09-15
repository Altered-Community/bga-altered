<?php
namespace ALT\Cards\MU;

class MU_Base_ResilienceTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-35_Mana_Web_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Resilience Training');
    $this->type = SPELL;
    $this->subtype = '';
    $this->rarity = RARITY_BASE;
    $this->costHand = 2;
    $this->costMemory = 2;
  }
}
