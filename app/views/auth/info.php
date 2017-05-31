<div class="container">
  <div class="col-md-3">

  </div>
  <div class="col-md-6">
    <div class="col-xs-4">
      <div class="_avatar">

        <?php
          if (isset($_SESSION['avatar']) && $_SESSION['avatar'] !== '') {
            echo '<img width="100px" src="/uploads/'.$_SESSION['avatar'].'" alt="">';
          }

         ?>
      </div>

    </div>
    <div class="col-xs-8">

      <?php
        if (isset($_SESSION['email']) && $_SESSION['email'] !== '') {
          echo "name: ".$_SESSION["name"];
          echo "<br>email: <strong>".$_SESSION["email"]."</strong>";
          echo "<br>role_id: ".$_SESSION["role_id"];
          echo '<br><a class="btn btn-primary" href="/auth/edit">change pass</a>';
        }



       ?>
    </div>
  </div>
  <div class="col-md-3">

  </div>
</div>
