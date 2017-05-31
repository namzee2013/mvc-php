<?php
  class Home extends Controller
  {
    public $name = 'home';
    public function index()
    {
      $user = $this->model('User');
      if (isset($_SESSION['email']) && $_SESSION['email'] !== '') {
        $user = $this->model('User');
        $data = $user->selectAll();
        $td = '';
        $i = 1;
        while ($row = $data->fetch_assoc()) {
          $td = $td . '<tr><td>' .$i.'</td>'.
          '<td>' .$row['name'].'</td>'.
          '<td>' .$row['email'].'</td>'.
          '<td>' .$row['avatar'].'</td>'.
          '<td>' .$row['role'].'</td>';
          if ($_SESSION['role_id'] < $row['role_id']) {

            $td = $td . '<td><a class="btn btn-primary" href="/home/edit/'.$row['id'].'">edit</a><a class="btn btn-danger" href="/home/delete/'.$row['id'].'" onclick="return checkDelete()">delete</a></td></tr>';
          }else{
            $td = $td . '<td></td></tr>';
          }

          $i++;
        }
        $this->view('home/index', ['td'=>$td]);
      }else {
        header("location:../auth/login");
      }


    }
    public function create(){
      $role = $this->model('Role');
      $roles = $role->findAll();

      $opt = '';
      foreach ($roles as $key => $value) {
        $opt =  $opt . '<option value="'.$value['id'].'">'.$value['role'].'</option>';
      }
      $this->view('home/create',['option'=>$opt]);
    }

    public function save()
    {
      $_SESSION['createErr'] = $_SESSION['nameErr'] = $_SESSION['emailErr'] = $_SESSION['passwordErr'] = $_SESSION['repassErr'] = $_SESSION['roleErr'] = '';
      $flag = 0;
      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
        $user = $this->model('User');
        if (empty($_POST['name']) || trim($_POST['name']) === '') {
          $_SESSION['nameErr'] = 'Name is required';
          $flag = 1;
        }else {
          $user->name = $_POST['name'];

        }
        if (empty($_POST['email']) || trim($_POST['email']) === '') {
          $_SESSION['emailErr'] = 'Email is required';
          $flag = 1;
        }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
          $_SESSION['emailErr'] = 'Invalid email format';
          $flag = 1;
        }else{
          $user->email = $_POST['email'];

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
        }
        if (empty($_POST['role_id'])) {
          $_SESSION['roleErr'] = 'role is required';
          $flag = 1;
        }elseif($_SESSION['role_id'] >= $_POST['role_id']) {
          $_SESSION['roleErr'] = 'access denied';
          $flag = 1;
        }else {
          $user->role_id = $_POST['role_id'];
        }
        if ($flag == 1) {
          header("location:create");
        }else{
          //$user->create($user);
          $data = $user->created($user);
          if($data === 'err'){
            $_SESSION['createErr'] = 'Email is exists';
            header("location:create");
          }else{
            $_SESSION['index'] = '';
            $_SESSION['indexSuccess'] = 'create success';
            header("location:../home/index");
          }
        }
      }
    }
    public function edit()
    {
      $id = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL))[2];
      $user = $this->model('User');
      $user->id = $id;
      $data = $user->findEdit($user);
      $row = $data->fetch_assoc();

      $role = $this->model('Role');
      $roles = $role->findAll();

      $opt = '';
      foreach ($roles as $key => $value) {
        if ($row['role_id'] === $value['id']) {
          $opt =  $opt . '<option selected value="'.$value['id'].'">'.$value['role'].'</option>';
        }else{
          $opt =  $opt . '<option value="'.$value['id'].'">'.$value['role'].'</option>';
        }

      }

      $this->view('home/edit', ['opt'=>$opt,'id'=>$row['id'],'name'=>$row['name'],'email'=>$row['email'],'avatar'=>$row['avatar']]);
    }
    public function update()
    {
      $_SESSION['updateErr'] = $_SESSION['nameErr'] = $_SESSION['emailErr'] = $_SESSION['passwordErr'] = $_SESSION['repassErr'] = $_SESSION['roleErr'] = '';
      $flag = 0;
      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
        $user = $this->model('User');
        $user->id = $_POST['id'];
        $user->avatar = $_POST['avatar'];
        if (empty($_POST['name']) || trim($_POST['name']) === '') {
          $_SESSION['nameErr'] = 'Name is required';
          $flag = 1;
        }else {
          $user->name = $_POST['name'];

        }
        if (empty($_POST['email']) || trim($_POST['email']) === '') {
          $_SESSION['emailErr'] = 'Email is required';
          $flag = 1;
        }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
          $_SESSION['emailErr'] = 'Invalid email format';
          $flag = 1;
        }else{
          $user->email = $_POST['email'];

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
        }
        if (empty($_POST['role_id'])) {
          $_SESSION['roleErr'] = 'role is required';
          $flag = 1;
        }elseif($_SESSION['role_id'] >= $_POST['role_id']) {
          $_SESSION['roleErr'] = 'access denied';
          $flag = 1;
        }else {
          $user->role_id = $_POST['role_id'];
        }
        if ($flag == 1) {
          header("location:edit/$user->id");
        }else{

          //$user->updatedUser($user);
          $data = $user->updatedUser($user);
          if($data === 'err'){
            $_SESSION['updateErr'] = 'Sorry! error';
            header("location:edit/$user->id");
          }else{
            $_SESSION['index'] = '';
            $_SESSION['indexSuccess'] = 'update success';
            header("location:../home/index");
          }
        }
      }
    }
    public function delete()
    {
      $_SESSION['index'] = '';
      $_SESSION['indexSuccess'] = '';
      $user = $this->model('User');
      $id = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL))[2];
      $data = $user->deletedUser($id);
      if ($data === 'err') {
        $_SESSION['index'] = 'Error delete this user';
        $_SESSION['indexSuccess'] = '';
        header("location:../home/index");
      }else{
        $_SESSION['index'] = '';
        $_SESSION['indexSuccess'] = 'delete success';
        header("location:../home/index");
      }
    }
  }
