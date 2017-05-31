<?php
require_once 'Connection.php';
require_once 'Connectmysqli.php';
class User extends Connectmysqli
{
  public $id, $name, $email, $password, $avatar, $role_id;
  public function save($user)
  {
    $user->email = mb_convert_encoding($user->email, "HTML-ENTITIES", "UTF-8");
    $user->password = mb_convert_encoding($user->password, "HTML-ENTITIES", "UTF-8");
    $user->password = md5($user->password);
    $user->name = mb_convert_encoding($user->name, "HTML-ENTITIES", "UTF-8");
    $user->avatar = mb_convert_encoding($user->avatar, "HTML-ENTITIES", "UTF-8");

    $sql = 'INSERT INTO `users`(`name`,`email`,`password`,`avatar`,`role_id`) VALUES("'.$user->name.'","'.$user->email.'","'.$user->password.'","'.$user->avatar.'",3)';
    $result = $this->create($sql);
    if ($result === 'success') {
      return $user;
    }else {
      return 'err';
    }

    //print_r($sql);

    // $file = fopen("data.txt", "a+") or die("Unable to open file!");
    // while(!feof($file)) {
    //   $str = fgets($file);
    //   $data = json_decode($str);
    //   if (isset($data->email) && $data->email === $user->email) {
    //     return 'email';
    //     break;
    //   }
    // }
    // $data = json_encode($user);
    // fwrite($file, $data);
    // fwrite($file, "\n");
    // fclose($file);
    // return $user;
  }

  public function find($user)
  {
    $email = mb_convert_encoding($user->email, "HTML-ENTITIES", "UTF-8");
    $password = mb_convert_encoding($user->password, "HTML-ENTITIES", "UTF-8");
    $password = md5($password);

    $sql = 'SELECT * FROM users WHERE `email`="'.$email.'" and `password`="'.$password.'"';
    $result = $this->select($sql);
    if ($result->num_rows > 0) {
      return $result;
    }else {
      return 'err';
    }

    //
    // $file = fopen("data.txt", "r") or die("Unable to open file!");
    // while(!feof($file)) {
    //   $str = fgets($file);
    //   $data = json_decode($str);
    //
    //   if ($data->email === $email && $data->password === $password) {
    //     $ok = true;
    //     $success = $data;
    //     break;
    //   }
    // }
    // fclose($file);
    // if ($ok) {
    //   return $success;
    // }else {
    //   return 'err';
    // }
  }

  public function updated($user)
  {

    $user->email = mb_convert_encoding($user->email, "HTML-ENTITIES", "UTF-8");
    $user->password = mb_convert_encoding($user->password, "HTML-ENTITIES", "UTF-8");
    $user->password = md5($user->password);
    $user->name = mb_convert_encoding($user->name, "HTML-ENTITIES", "UTF-8");
    $user->avatar = mb_convert_encoding($user->avatar, "HTML-ENTITIES", "UTF-8");

    //print_r($user->avatar);
    $sql = "UPDATE `users` set `name` = '$user->name', `password` = '$user->password', `avatar` = '$user->avatar' where `email` = '$user->email'";

    $result = $this->update($sql);
    if ($result === 'success') {
      return $user;
    }else {
      return 'err';
    }
  }
  public function selectAll(){
    $sql = 'SELECT users.id,name,email,avatar,role,role_id FROM `users` INNER JOIN roles ON users.role_id = roles.id';

    $result = $this->select($sql);
    if ($result->num_rows > 0) {
      return $result;
    }else{
      return 'err';
    }
  }

  public function created($user){
    $user->email = mb_convert_encoding($user->email, "HTML-ENTITIES", "UTF-8");
    $user->password = mb_convert_encoding($user->password, "HTML-ENTITIES", "UTF-8");
    $user->password = md5($user->password);
    $user->name = mb_convert_encoding($user->name, "HTML-ENTITIES", "UTF-8");
    $user->avatar = mb_convert_encoding($user->avatar, "HTML-ENTITIES", "UTF-8");
    $user->role_id = $user->role_id;

    $sql = 'INSERT INTO `users`(`name`,`email`,`password`,`avatar`,`role_id`) VALUES("'.$user->name.'","'.$user->email.'","'.$user->password.'","'.$user->avatar.'",'.$user->role_id.')';
    $result = $this->create($sql);
    if ($result === 'success') {
      return $user;
    }else {
      return 'err';
    }
  }
  public function findEdit($user)
  {
    $sql = 'SELECT * FROM `users` WHERE `id`='.$user->id;
    $result = $this->select($sql);
    if ($result->num_rows > 0) {
      return $result;
    }else{
      return 'err';
    }
  }
  public function updatedUser($user)
  {
    $user->email = mb_convert_encoding($user->email, "HTML-ENTITIES", "UTF-8");
    $user->password = mb_convert_encoding($user->password, "HTML-ENTITIES", "UTF-8");
    $user->password = md5($user->password);
    $user->name = mb_convert_encoding($user->name, "HTML-ENTITIES", "UTF-8");
    $user->avatar = mb_convert_encoding($user->avatar, "HTML-ENTITIES", "UTF-8");

    $sql = "UPDATE `users` set `name` = '$user->name', `email` = '$user->email', `password` = '$user->password', `avatar` = '$user->avatar', `role_id` = $user->role_id where `id` = '$user->id'";
    $result = $this->update($sql);
    if ($result === 'success') {
      return $user;
    }else {
      return 'err';
    }
  }
  public function deletedUser($id)
  {
    $sql = 'DELETE FROM `users` WHERE `id`='.$id;
    $result = $this->update($sql);
    if ($result === 'success') {
      return $result;
    }else {
      return 'err';
    }
  }
}
