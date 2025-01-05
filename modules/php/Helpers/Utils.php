<?php

namespace ALT\Helpers;

abstract class Utils extends \APP_DbObject
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
  public static function GAIN($token, $n = 1)
  {
    return self::ACTION(GAIN, ['type' => $token, 'n' => $n]);
  }

  public static function filter(&$data, $filter)
  {
    $data = array_values(array_filter($data, $filter));
  }

  public static function rand($array, $n = 1)
  {
    $keys = array_rand($array, $n);
    if ($n == 1) {
      $keys = [$keys];
    }
    $entries = [];
    foreach ($keys as $key) {
      $entries[] = $array[$key];
    }
    shuffle($entries);
    return $entries;
  }

  public static function search($array, $test)
  {
    $found = false;
    $iterator = new \ArrayIterator($array);

    while ($found === false && $iterator->valid()) {
      if ($test($iterator->current())) {
        $found = $iterator->key();
      }
      $iterator->next();
    }

    return $found;
  }

  public static function topological_sort($nodeids, $edges)
  {
    $L = $S = $nodes = [];
    foreach ($nodeids as $id) {
      $nodes[$id] = ['in' => [], 'out' => []];
      foreach ($edges as $e) {
        if ($id == $e[0]) {
          $nodes[$id]['out'][] = $e[1];
        }
        if ($id == $e[1]) {
          $nodes[$id]['in'][] = $e[0];
        }
      }
    }
    foreach ($nodes as $id => $n) {
      if (empty($n['in'])) {
        $S[] = $id;
      }
    }
    while (!empty($S)) {
      $L[] = $id = array_shift($S);
      foreach ($nodes[$id]['out'] as $m) {
        $nodes[$m]['in'] = array_diff($nodes[$m]['in'], [$id]);
        if (empty($nodes[$m]['in'])) {
          $S[] = $m;
        }
      }
      $nodes[$id]['out'] = [];
    }
    foreach ($nodes as $n) {
      if (!empty($n['in']) or !empty($n['out'])) {
        return null; // not sortable as graph is cyclic
      }
    }
    return $L;
  }

  public static function die($args = null)
  {
    throw new \BgaVisibleSystemException(json_encode($args));
  }

  /**
   * Return a string corresponding to an assoc array of resources
   */
  public static function resourcesToStr($resources, $keepZero = false)
  {
    $descs = [];
    foreach ($resources as $resource => $amount) {
      if (in_array($resource, ['sources', 'sourcesDesc', 'cardId', 'cId', 'pId', 'income'])) {
        continue;
      }

      if ($amount == 0 && !$keepZero) {
        continue;
      }

      if (in_array($resource, [])) {
        $descs[] = '<' . strtoupper($resource) . ':' . $amount . '>';
      } else {
        $descs[] = $amount . '<' . strtoupper($resource) . '>';
      }
    }
    return implode(',', $descs);
  }

  public static function tagTree($t, $tags, $replaceOnly = false)
  {
    foreach ($tags as $tag => $v) {
      if (!$replaceOnly || ($replaceOnly && isset($t[$tag]))) {
        $t[$tag] = $v;
      }
    }

    if (isset($t['childs'])) {
      $t['childs'] = array_map(function ($child) use ($tags, $replaceOnly) {
        return self::tagTree($child, $tags, $replaceOnly);
      }, $t['childs']);
    }
    return $t;
  }

  public static function updateTree($t, $searched, $newValue, $limitedKeys = [])
  {
    foreach ($t as $key => $value) {
      if ($limitedKeys == [] && $value === $searched) {
        $t[$key] = $newValue;
      } elseif (in_array($key, $limitedKeys)  && $value === $searched) {
        $t[$key] = $newValue;
      } elseif (is_array($value)) {
        $t[$key] = self::updateTree($value, $searched, $newValue, $limitedKeys);
      }
    }

    return $t;
  }

  public static function searchTree($t, $searched)
  {
    foreach ($t as $key => $value) {
      if ($value === $searched) {
        return true;
      } elseif (is_array($value)) {
        return self::searchTree($value, $searched);
      }
    }

    return false;
  }

  public static function formatFee($cost)
  {
    return [
      'fees' => [$cost],
    ];
  }

  public static function uniqueZones($arr1)
  {
    return array_values(
      array_uunique($arr1, function ($a, $b) {
        return $a['x'] == $b['x'] ? $a['y'] - $b['y'] : $a['x'] - $b['x'];
      })
    );
  }

  /**
   * Intersect two arrays of obj with keys x,y
   */
  public static function intersectZones($arr1, $arr2)
  {
    return array_values(
      \array_uintersect($arr1, $arr2, function ($a, $b) {
        return $a['x'] == $b['x'] ? $a['y'] - $b['y'] : $a['x'] - $b['x'];
      })
    );
  }

  /**
   * Diff two arrays of obj with keys x,y
   */
  public static function diffZones($arr1, $arr2)
  {
    return array_values(
      array_udiff($arr1, $arr2, function ($a, $b) {
        return $a['x'] == $b['x'] ? $a['y'] - $b['y'] : $a['x'] - $b['x'];
      })
    );
  }

  public static function bonus_diff($array1, $array2)
  {
    $result = [];
    foreach ($array1 as $key => $val) {
      if (!in_array($val, $array2)) {
        $result[] = $val;
      }
    }

    return $result;
  }

  public static function cartesian($input)
  {
    $result = [[]];

    foreach ($input as $key => $values) {
      $append = [];
      $values = array_unique($values, SORT_NUMERIC);

      foreach ($result as $product) {
        foreach ($values as $item) {
          $product[$key] = $item;
          $append[] = $product;
        }
      }

      $result = $append;
    }

    return $result;
  }

  public static function convertFaction($faction)
  {
    switch ($faction) {
      case 'AX':
        return FACTION_AX;
        break;
      case 'OR':
        return FACTION_OD;
        break;
      case 'BR':
        return FACTION_BR;
        break;
      case 'LY':
        return FACTION_LY;
        break;
      case 'MU':
        return FACTION_MU;
        break;
      case 'YZ':
        return FACTION_YZ;
        break;
    }
  }

  public static function checkAttributeCondition($attribute, $data, $player, $card)
  {
    $attributeData = explode(':', $data);
    if (count($attributeData) == 1) {
      return $attributeData[0];
    } else {
      $condArgs = array_slice($attributeData, 1);
      // there is a condition after
      if (Conditions::check(['condition' => implode(':', $condArgs)], $card, [])) {
        return $attributeData[0];
      }
      return  null;
    }
  }
}

function array_uunique($array, $comparator)
{
  $unique_array = [];
  do {
    $element = array_shift($array);
    $unique_array[] = $element;

    $array = array_udiff($array, [$element], $comparator);
  } while (count($array) > 0);

  return $unique_array;
}
