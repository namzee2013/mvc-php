
<div class="panel panel-default">
  <div class="panel-heading">
    <h1>REGISTER</h1>
  </div>
  <div class="panel-body">
    <span class="error"><?php
      if (isset($_SESSION['registerErr']) && $_SESSION['registerErr'] !== '') {
        echo '<div class="alert alert-danger">'.$_SESSION['registerErr'].'</div>';
      }
     ?></span>
    <form class="form-horizontal" action="save" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-3">
            <label class="pull-right" for="name">name<span class="error">*</span></label>
          </div>
          <div class="col-xs-12 col-md-6">
            <input class="form-control" type="text" name="name" value="">
            <span class="error"><?php
              if (isset($_SESSION['nameErr']) && $_SESSION['nameErr'] !== '') {
                echo $_SESSION['nameErr'];
              }
             ?></span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-3">
            <label class="pull-right" for="email">email<span class="error">*</span></label>
          </div>
          <div class="col-xs-12 col-md-6">
            <input class="form-control" type="text" name="email" value="">
            <span class="error"><?php
              if (isset($_SESSION['emailErr']) && $_SESSION['emailErr'] !== '') {
                echo $_SESSION['emailErr'];
              }
             ?></span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-3">
            <label class="pull-right" for="name">password<span class="error">*</span></label>
          </div>
          <div class="col-xs-12 col-md-6">
            <input class="form-control" type="password" name="password" value="">
            <span class="error"><?php
              if (isset($_SESSION['passwordErr']) && $_SESSION['passwordErr'] !== '') {
                echo $_SESSION['passwordErr'];
              }
             ?></span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-3">
            <label class="pull-right" for="name">re-password<span class="error">*</span></label>
          </div>
          <div class="col-xs-12 col-md-6">
            <input class="form-control" type="password" name="repassword" value="">
            <span class="error"><?php
              if (isset($_SESSION['repassErr']) && $_SESSION['repassErr'] !== '') {
                echo $_SESSION['repassErr'];
              }
             ?></span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-6 col-md-push-3">
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            <a href="/auth/login">login</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
