<?php

$cards = [
  // 'eqType' => ['type' => , ....]
  // 'location' => 'card_location',
  // 'state' => ['card_state', 'int'],
  // 'pId' => ['player_id', 'int'],
  // 'type' => ['type', 'str'], // Token/hero/adventurer/spell
  // 'tapped' => ['tapped', 'bool'],
  // 'costHand' => ['costHand', 'int'],
  // 'costMemory' => ['costMemory', 'int'],
  // 'name' => ['name', 'str'], // obj?
  // 'rarity' => ['rarity', 'int'],
  // 'equinoxId' => ['equinoxId', 'int'],
  // 'mountain' => ['mountain', 'int'],
  // 'forest' => ['forest', 'int'],
  // 'water' => ['water', 'int'],
  // 'boostEffect' => ['boostEffect', 'obj'], // ['mountain' => X, 'forest' => Y, ...]
  // 'faction' => ['faction', 'str'],
  // 'effectEcho' => ['effectEcho', 'obj'],
  // 'effectHand' => ['effectHand', 'obj'], // played from hand
  // 'effectMemory' => ['effectMemory', 'obj'], // played from memory
  // 'effectPassive' => ['effectPassive', 'obj'], // [[listener type => action]]: listener type to distinguish
  // 'costModifier' => ['costModifier', 'obj'], // ['hand'=> action check, 'memory' => action check]
  // 'extraDatas' => ['extra_datas', 'obj'],
  // // attributs persistants
  // 'initialProperties' => ['initial_properties', 'obj'],
  // 'properties' => ['properties', 'obj'], // will superseed original properties if needed
  'phoenixianCaptain' => [
    'location' => 'deck',
    'type' => 'adventurer',
    'costHand' => 2,
    'costMemory' => 1,
    'card_name' => clienttranslate('Phoenixian Captain'),
    'rarity' => RARITY_RARE,
    'water' => 2,
    'faction' => 'toto',
    'effectHand' => ['titi'],
  ],
];
