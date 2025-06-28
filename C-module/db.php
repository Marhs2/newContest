<?php
session_start();

class DB
{
  static $db = null;
  static function getDB()
  {
    if (!self::$db) self::$db = new PDO("mysql:host=localhost;dbname=practice;charset=utf8mb4", "root", "", [19 => 5, 3 => 2]);
    return self::$db;
  }


  static function exec($query)
  {
    return self::getDB()->exec($query);
  }

  static function fetch($query)
  {
    return self::getDB()->query($query)->fetch();
  }

  static function fetchAll($query)
  {
    return self::getDB()->query($query)->fetchAll();
  }
}
