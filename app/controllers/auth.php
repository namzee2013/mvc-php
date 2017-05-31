<?php

/**
 *
 */
class Auth extends Controller
{

  public $name = 'auth';
  public function info()
  {
    $this->view('auth/info');
  }
  public function register()
  {
    $user = $this->model('User');
    $this->view('auth/register');
  }

  public function save()
  {
    $_SESSION['registerErr'] = $_SESSION['nameErr'] = $_SESSION['emailErr'] = $_SESSION['passwordErr'] = $_SESSION['repassErr'] = '';
    $flag = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $user = $this->model('User');
      if (empty($_POST['name']) || trim($_POST['name']) === '') {
        $_SESSION['nameErr'] = 'Name is required';
        $flag = 1;
      }else {
        $user->name = $_POST['name'];
        $flag = 0;
      }
      if (empty($_POST['email']) || trim($_POST['email']) === '') {
        $_SESSION['emailErr'] = 'Email is required';
        $flag = 1;
      }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $_SESSION['emailErr'] = 'Invalid email format';
        $flag = 1;
      }else{
        $user->email = $_POST['email'];
        $flag = 0;
      }
      if (empty($_POST['password'])) {
        $_SESSION['passwordErr'] = 'Password is required';
        $flag = 1;
      }else {
        $user->password = $_POST['password'];
        $flag = 0;
      }
      if (empty($_POST['repassword'])) {
        $_SESSION['repassErr'] = 'Password is required';
        $flag = 1;
      }elseif($_POST['password'] !== $_POST['repassword']){
        $_SESSION['repassErr'] = 'Password and re-password not match';
        $flag = 1;
      }else {
        $flag = 0;
      }

      if ($flag == 1) {
        header("location:register");
      }else{
        //$user->save($user);
        $data = $user->save($user);
        if($data === 'err'){
          $_SESSION['registerErr'] = 'Email is exists';
          header("location:register");
        }else{
          $_SESSION['email'] = $data->email;
          $_SESSION['name'] = $data->name;
          $_SESSION['avatar'] = $data->avatar;
          $_SESSION['role_id'] = 3;
          header("location:../home/index");
        }

      }
    }
  }

  public function login()
  {
    $_SESSION['email'] = $_SESSION['name'] = $_SESSION['avatar'] = $_SESSION['role_id'] = '';
    $user = $this->model('User');
    $this->view('auth/login');
  }

  public function find(){
    $flag = 0;
    $_SESSION['emailErr'] = $_SESSION['passwordErr'] = $_SESSION['loginError'] = '' ;
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $user = $this->model('User');
      if (empty($_POST['email']) || trim($_POST['email']) === '') {
        $_SESSION['emailErr'] = 'Email is required';
        $flag = 1;
      }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['emailErr'] = 'Invalid email format';
        $flag = 1;
      }else{
        $user->email = $_POST['email'];
        $flag = 0;
      }

      if (empty($_POST['password'])) {
        $_SESSION['passwordErr'] = 'Password in required';
        $flag = 1;
      }else {
        $user->password = $_POST['password'];
        $flag = 0;
      }
      if ($flag === 0) {
        $user->find($user);
        $data = $user->find($user);
        if ($data == 'err') {
          $_SESSION['loginErr'] = 'email or password is Invalid';
          header("location:login");
        }else {
          $data = $data->fetch_assoc();
          $_SESSION['email'] = $data['email'];
          $_SESSION['name'] = $data['name'];
          $_SESSION['avatar'] = $data['avatar'];
          $_SESSION['role_id'] = $data['role_id'];
          header("location:/");
        }

      }else{
        header("location:login");
      }
    }
  }

  public function logout()
  {
    $_SESSION['email'] = $_SESSION['name'] = $_SESSION['avatar'] = $_SESSION['role_id'] = '' ;
    header("location:login");
  }
  public function edit()
  {
    if (isset($_SESSION['email']) && $_SESSION['email'] !== '') {
      //$user = $this->model('User');

      $this->view('auth/edit');
    }else{
      header("location:login");
    }

  }
  public function update()
  {
    $_SESSION['editErr'] = $_SESSION['nameErr'] = $_SESSION['emailErr'] = $_SESSION['passwordErr'] = $_SESSION['repassErr'] = $_SESSION['fileErr'] = '';
    $flag = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $user = $this->model('User');
      $user->email = $_SESSION['email'];
      if (empty($_POST['name']) || $_POST['name'] === '') {
        $flag = 1;
        $_SESSION['nameErr'] = 'Name is required';
      }else {
        $user->name = $_POST['name'];
        $flag = 0;
      }
      if (empty($_POST['password'])) {
        $_SESSION['passwordErr'] = 'Password is required';
        $flag = 1;
      }else {
        $user->password = $_POST['password'];
        $flag = 0;
      }
      if (empty($_POST['repassword'])) {
        $_SESSION['repassErr'] = 'Password is required';
        $flag = 1;
      }elseif($_POST['password'] !== $_POST['repassword']){
        $_SESSION['repassErr'] = 'Password and re-password not match';
        $flag = 1;
      }else {
        $flag = 0;
      }

      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      if ($_FILES['avatar']['error'] > 0) {
          $_SESSION['fileErr'] = $_SESSION['fileErr'] . "Sorry, avatar is required | ";
      }
      if (file_exists($target_file)) {
          $_SESSION['fileErr'] = $_SESSION['fileErr'] . "Sorry, file already exists. | ";
          $uploadOk = 0;
          $flag = 1;
      }
      // Check file size
      if ($_FILES["avatar"]["size"] > 500000) {
          $_SESSION['fileErr'] = $_SESSION['fileErr'] . "Sorry, your file is too large. | ";
          $uploadOk = 0;
          $flag = 1;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
          $_SESSION['fileErr'] = $_SESSION['fileErr'] . "Sorry, only JPG, JPEG, PNG & GIF files are allowed. | ";
          $uploadOk = 0;
          $flag = 1;
      }
      if ($uploadOk === 0) {
          $_SESSION['fileErr'] = $_SESSION['fileErr'] . "Sorry, your file was not uploaded. | ";
          $flag = 1;
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
              $user->avatar = basename($_FILES["avatar"]["name"]);
              $flag = 0;
          } else {
              $_SESSION['fileErr'] = $_SESSION['fileErr'] . "Sorry, there was an error uploading your file. | ";
              $flag = 1;
          }
      }
      if ($flag === 1) {
        header("location:edit");
      }else{

        $data = $user->updated($user);
        if($data === 'err'){
          $_SESSION['editErr'] = 'Error!!!';
          header("location:edit");
        }else{
          $_SESSION['email'] = $data->email;
          $_SESSION['name'] = $data->name;
          $_SESSION['avatar'] = $data->avatar;
          $_SESSION['role_id'] = $data->role_id;
          header("location:../home/index");
        }

      }
    }
  }
}
