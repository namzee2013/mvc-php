<?php
require_once 'Connection.php';
require_once 'Connectmysqli.php';
class Role extends Connectmysqli
{
  public $role, $description;
  public function findAll()
  {
    $sql = 'SELECT * FROM `roles`';
    $result = $this->select($sql);
    return $result;
  }
}
