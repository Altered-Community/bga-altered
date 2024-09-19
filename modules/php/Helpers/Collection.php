<?php

namespace ALT\Helpers;

class Collection extends \ArrayObject
{
  public function getIds()
  {
    return array_keys($this->getArrayCopy());
  }

  public function empty()
  {
    return empty($this->getArrayCopy());
  }

  public function has($key)
  {
    return array_key_exists($key, $this->getArrayCopy());
  }

  public function first()
  {
    $arr = $this->toArray();
    return isset($arr[0]) ? $arr[0] : null;
  }

  public function rand()
  {
    $arr = $this->getArrayCopy();
    $key = array_rand($arr, 1);
    return $arr[$key];
  }

  public function toArray()
  {
    return array_values($this->getArrayCopy());
  }

  public function toAssoc()
  {
    return $this->getArrayCopy();
  }

  public function map($func)
  {
    return new Collection(array_map($func, $this->toAssoc()));
  }

  public function merge($arr)
  {
    return new Collection($this->toAssoc() + $arr->toAssoc());
  }

  public function reduce($func, $init)
  {
    return array_reduce($this->toArray(), $func, $init);
  }

  public function filter($func)
  {
    return new Collection(array_filter($this->toAssoc(), $func));
  }

  public function limit($n)
  {
    return new Collection(array_slice($this->toAssoc(), 0, $n, true));
  }

  public function includes($t)
  {
    return in_array($t, $this->getArrayCopy());
  }

  public function ui()
  {
    return $this->map(function ($elem) {
      return $elem->getUiData();
    })->toArray();
  }

  public function uiAssoc()
  {
    return $this->map(function ($elem) {
      return $elem->getUiData();
    })->toAssoc();
  }

  public function order($callback)
  {
    $t = $this->getArrayCopy();
    \uasort($t, $callback);
    return new Collection($t);
  }

  public function jsonSerialize()
  {
    return $this->map(function ($elem) {
      return $elem->jsonSerialize();
    });
  }

  /*****
   * Méthods for collection of object
   */
  public function where($field, $value)
  {
    return is_null($value)
      ? $this
      : $this->filter(function ($obj) use ($field, $value) {
        $method = 'get' . ucfirst($field);
        if (is_null($obj)) {
          return;
        }
        $objValue = $obj->$method();
        return is_array($value)
          ? in_array($objValue, $value)
          : (is_array($objValue)
            ? in_array($value, $objValue)
            : (strpos($value, '%') !== false
              ? like_match($value, $objValue)
              : $objValue == $value));
      });
  }

  public function whereNot($field, $value)
  {
    return is_null($value)
      ? $this
      : $this->filter(function ($obj) use ($field, $value) {
        $method = 'get' . ucfirst($field);
        $objValue = $obj->$method();
        return is_array($value)
          ? !in_array($objValue, $value)
          : (is_array($objValue)
            ? !in_array($value, $objValue)
            : (strpos($value, '%') !== false
              ? !like_match($value, $objValue)
              : $objValue != $value));
      });
  }

  public function whereNull($field)
  {
    return $this->filter(function ($obj) use ($field) {
      $method = 'get' . ucfirst($field);
      $objValue = $obj->$method();
      return is_null($objValue);
    });
  }

  public function orderBy($field, $asc = 'ASC')
  {
    return $this->order(function ($a, $b) use ($field, $asc) {
      $method = 'get' . ucfirst($field);
      return $asc == 'ASC' ? $a->$method() - $b->$method() : $b->$method() - $a->$method();
    });
  }

  public function update($field, $value)
  {
    $method = 'set' . ucfirst($field);
    foreach ($this->getArrayCopy() as $obj) {
      $obj->$method($value);
    }
    return $this;
  }
}

function like_match($pattern, $subject)
{
  $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
  return (bool) preg_match("/^{$pattern}$/i", $subject);
}
