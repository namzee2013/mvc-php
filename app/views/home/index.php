
<div class="panel panel-default">
  <div class="panel-heading">

    <h1>USER</h1>

    <a class="btn btn-primary" href="/home/create">CREATE</a>
  </div>
  <div class="panel-body">
    <?php
      if (isset($_SESSION['index']) && $_SESSION['index'] !== '') {
        echo '<div class="alert alert-danger">'.$_SESSION['index'].'</div>';
      }
      if (isset($_SESSION['indexSuccess']) && $_SESSION['indexSuccess'] !== '') {
        echo '<div class="alert alert-success">'.$_SESSION['indexSuccess'].'</div>';
      }
   ?>
    <table class="table">
      <thead class="thead-inverse">
        <tr>
          <th>#</th>
          <th>name</th>
          <th>email</th>
          <th>avatar</th>
          <th>role</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        <?= $data['td'] ?>
      </tbody>
    </table>
  </div>
</div>
