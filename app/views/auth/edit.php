
<div class="panel panel-default">
  <div class="panel-heading">
    <h1>EDIT</h1>
  </div>
  <div class="panel-body">

     <?php
      if (isset($_SESSION['editErr']) && $_SESSION['editErr'] !== '') {
        echo '<div class="alert alert-danger">'.$_SESSION['editErr'].'</div>';
      }
     ?>
    <form class="form-horizontal" action="update" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-3">
            <label class="pull-right" for="name">name<span class="error">*</span></label>
          </div>
          <div class="col-xs-12 col-md-6">
            <input class="form-control" type="text" name="name" value="<?php echo $_SESSION['name'] ?>">
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
            <input  disabled=""class="form-control" type="text" name="email" value="<?php echo $_SESSION['email'] ?>">
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
          <div class="col-xs-12 col-md-3">
            <label class="pull-right" for="avatar">avatar current</label>
          </div>
          <div class="col-xs-12 col-md-6">
            <?php
              if (isset($_SESSION['avatar']) && $_SESSION['avatar'] != '') {
                echo '<img width="50px" src="/uploads/'.$_SESSION["avatar"].'" alt="">';
              }
             ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-3">
            <label class="pull-right" for="avatar">avatar<span class="error">*</span></label>
          </div>
          <div class="col-xs-12 col-md-6">
            <input class="form-control" type="file" name="avatar" value="">
            <span class="error"><?php
              if (isset($_SESSION['fileErr']) && $_SESSION['fileErr'] !== '') {
                echo $_SESSION['fileErr'];
              }
             ?></span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-6 col-md-push-3">
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
