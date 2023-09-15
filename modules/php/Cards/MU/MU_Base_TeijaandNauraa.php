<?php
namespace ALT\Cards\MU;

class MU_Base_TeijaandNauraa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'MU-02_Teija-Nauraa_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_MU;
    $this->name = clienttranslate('Teija and Nauraa');
    $this->type = ALTERATEUR;
    $this->subtype = 'Muna Hero';
    $this->rarity = RARITY_BASE;
  }
}
