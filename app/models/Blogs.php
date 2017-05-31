<?php

require_once 'Connectmysqli.php';
class Blogs extends Connectmysqli
{
  public $id, $content, $created_at, $user_id;

  public function selected($page, $limit)
  {
    $sql = 'SELECT * FROM `blogs`,`users` WHERE blogs.user_id = users.id ORDER BY blogs.id DESC LIMIT '.$page.','.$limit;
    $result = $this->select($sql);
    if ($result->num_rows >= 0) {
      return $result;
    }else{
      return 'err';
    }
  }
  public function getCount()
  {
    $sql = 'SELECT COUNT(id) FROM `blogs`';
    $result = $this->select($sql);
    return $result->fetch_assoc()['COUNT(id)'];
  }
  public function save($blog)
  {
    $sql = 'INSERT INTO `blogs`(`content`, `created_at`, `user_id`) VALUES ("'.$blog->content.'","'.$blog->created_at.'",'.$blog->user_id.')';
    $result = $this->create($sql);
    if ($result === 'success') {
      return 'success';
    }else {
      return 'err';
    }
  }
  public function findUser($email)
  {
    $sql = 'SELECT * FROM `users` WHERE `email` = "' .$email .'"';
    $result = $this->select($sql);
    if (sizeof($result)>0) {
      return $result;
    }else {
      return 'err';
    }
  }
}
