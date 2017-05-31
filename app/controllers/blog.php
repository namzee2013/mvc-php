<?php

class Blog extends Controller
{

  public $name = 'blog';
  public function index()
  {
    $_SESSION['blog'] = 'ok';
    if (isset($_SESSION['email']) && $_SESSION['email'] !== '')
    {

      $this->view('/blog/index');
    }else {
      header("location:/auth/login");
    }

  }
  public function save()
  {
    $response = array(
      'error' => 0
    );
    $blog = $this->model('Blogs');
    // $blog->created();
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    if (empty($content)) {
      $response['error'] = 1;
      $response['data'] = 'content is require';
      die (json_encode($response));
    }else {
      $user = $blog->findUser($_SESSION['email'])->fetch_assoc();
      $blog->content = $content;
      $blog->created_at = date("Y/m/d H:i:s");
      $blog->user_id = $user['id'];
      if ($blog->save($blog) === 'err') {
        $response['error'] = 1;
        $response['data'] = 'Sorry, access denied';
        die (json_encode($response));
      }else {
        if ($user['avatar'] === '') {
          $avatar = 'avat.png';
        }else{
          $avatar = $user['avatar'];
        }
        $name = $user['name'];
        $date = date('d/m/Y H:i:s',strtotime($blog->created_at));
        $content = $blog->content;
        $data = '<li>
          <div class="avatar">
            <img src="/uploads/'.$avatar.'">
            <div class="hover">
              <div class="icon-twitter"></div>
            </div>
          </div>
          <div class="bubble-container">
            <div class="bubble">
              <h3>@'.$name.'</h3>
              <h5 class="pull-right">'.$date.'</h5><br/>
              '.$content.'
              <div class="over-bubble">
                <div class="icon-mail-reply action"></div>
                <div class="icon-retweet action"></div>
                <div class="icon-star"></div>
              </div>
            </div>
            <div class="arrow"></div>
          </div>
        </li>';
        $response['error'] = 0;
        $response['data'] = $data;
        die (json_encode($response));
      }

    }

  }
  public function getblogs()
  {
    $response = array(
      'error' => 0
    );

    $blog = $this->model('Blogs');

    $limit = $_GET['limit'];
    $page = $_GET['page'];
    $total = $blog->getCount();

    $res = $blog->selected($page * $limit, $limit);
    if ($res->num_rows === 0) {
      $response['error'] = 1;
      die (json_encode($response));
    }else{
      $data = '';
      while ($row = $res->fetch_assoc()){
        if ($row['avatar'] !== '') {
          $avatar = $row['avatar'];
        }else {
          $avatar = 'avat.png';
        }
        $data .= '<li>
          <div class="avatar">
            <img src="/uploads/'.$avatar.'">
            <div class="hover">
              <div class="icon-twitter"></div>
            </div>
          </div>
          <div class="bubble-container">
            <div class="bubble">
              <h3>@'.$row['name'].'</h3>
              <h5 class="pull-right">'.date('d/m/Y H:i:s',strtotime($row['created_at'])).'</h5><br/>
              '.$row['content'].'
              <div class="over-bubble">
                <div class="icon-mail-reply action"></div>
                <div class="icon-retweet action"></div>
                <div class="icon-star"></div>
              </div>
            </div>
            <div class="arrow"></div>
          </div>
        </li>';
      }
      $response['data'] = $data;
      $response['page'] = $page;
      $response['limit'] = $limit;
      $response['total'] = $total;
      die (json_encode($response));
    }
  }
  public function loadmore()
  {

    $response = array(
      'error' => 0
    );
    $blog = $this->model('Blogs');

    $limit = $_GET['limit'];
    $page = $_GET['page'];
    $total = $blog->getCount();

    $res = $blog->selected($page * $limit, $limit);
    if ($res->num_rows === 0) {
      $response['error'] = 1;
      die (json_encode($response));
    }else{
      $data = '';
      while ($row = $res->fetch_assoc()){
        if ($row['avatar'] !== '') {
          $avatar = $row['avatar'];
        }else {
          $avatar = 'avat.png';
        }
        $data .= '<li>
          <div class="avatar">
            <img src="/uploads/'.$avatar.'">
            <div class="hover">
              <div class="icon-twitter"></div>
            </div>
          </div>
          <div class="bubble-container">
            <div class="bubble">
              <h3>@'.$row['name'].'</h3>
              <h5 class="pull-right">'.date('d/m/Y H:i:s',strtotime($row['created_at'])).'</h5><br/>
              '.$row['content'].'
              <div class="over-bubble">
                <div class="icon-mail-reply action"></div>
                <div class="icon-retweet action"></div>
                <div class="icon-star"></div>
              </div>
            </div>
            <div class="arrow"></div>
          </div>
        </li>';
      }
      $response['data'] = $data;
      $response['page'] = $page;
      $response['limit'] = $limit;
      $response['total'] = $total;
      die (json_encode($response));
    }
  }
}
