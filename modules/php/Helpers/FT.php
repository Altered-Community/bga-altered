<?php
namespace ALT\Helpers;

// Flow Tree
abstract class FT
{
  public static function SEQ(...$childs)
  {
    return [
      'type' => NODE_SEQ,
      'childs' => $childs,
    ];
  }

  public static function OR(...$childs)
  {
    return [
      'type' => NODE_OR,
      'childs' => $childs,
    ];
  }

  public static function PAR(...$childs)
  {
    return [
      'type' => NODE_PARALLEL,
      'childs' => $childs,
    ];
  }

  public static function ACTION($actionName, $args, $node = [])
  {
    $node['action'] = $actionName;
    $node['args'] = $args;
    return $node;
  }

  public static function GAIN($card, $token, $n = 1)
  {
    return self::ACTION(GAIN, ['cardId' => $card->getId(), 'type' => $token, 'n' => $n]);
  }

  public static function RETURN_TO_HAND()
  {
    return self::ACTION(DISCARD, ['target' => HAND]);
  }
}
