<?php
namespace ALT\Cards\BR;
use ALT\Core\Globals;

class BR_Base_KojoandBooda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_BR_1_1_2',
      'asset' => 'BR-01_Ekwu-Booda_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Kojo and Booda'),
      'type' => ALTERATEUR,
      'subtype' => 'Bravos Hero',
      'typeline' => 'Bravos Hero',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate(
        'At Dawn, if you are first player — Create a [Booda 2/2/2] Cat token in the Companion Expedition.'
      ),
      'memorySlots' => 2,
      'permanentSlots' => 2,
    ];
  }

  public function isListeningTo($event)
  {
    // To remove
    return Globals::getFirstPlayer() == $this->pId && $event['type'] == 'Dawn';
  }

  public function onDawn($player, $args)
  {
    return ['action' => INVOKE_TOKEN, 'args' => ['tokenType' => 'BR_Base_Booda', 'targetLocation' => [STORM_RIGHT]]];
  }
}
