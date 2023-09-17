<?php
namespace ALT\Helpers;

class CachedDB_Manager extends DB_Manager
{
  protected static $table = null;
  protected static $primary = null;
  protected static $log = null;
  protected static function cast($row)
  {
    return $row;
  }

  public static function fetchIfNeeded()
  {
    if (is_null(static::$datas)) {
      static::$datas = static::DB()->get();
    }
  }

  public function invalidate()
  {
    static::$datas = null;
  }

  public function getAll()
  {
    self::fetchIfNeeded();
    return static::$datas;
  }

  public function get($id)
  {
    return self::getAll()
      ->filter(function ($obj) use ($id) {
        return $obj->getId() == $id;
      })
      ->first();
  }
}
