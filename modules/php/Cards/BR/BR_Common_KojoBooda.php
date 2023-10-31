<?php
namespace ALT\Cards\BR;

class BR_Common_KojoBooda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '36',
      'asset' => 'BR-01-Ekwu-Booda-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Kojo & Booda'),
      'typeline' => clienttranslate('Bravos Hero'),
      'rarity' => RARITY_COMMON,
      'type' => HERO,
      'subtype' => '',

      'effectDesc' => clienttranslate(
        'At Dawn, if you have the first player Token - Create a [Booda 2/2/2] Cat token in your Companion Expedition.'
      ),
      'effectPassive' => [
        'Dawn' => [
          'condition' => 'isFirstPlayer',
          'output' => [
            'action' => INVOKE_TOKEN,
            'automatic' => true,
            'args' => ['tokenType' => 'BR_Base_Booda', 'targetLocation' => [STORM_RIGHT]],
          ],
        ],
      ],
    ];
  }
}
