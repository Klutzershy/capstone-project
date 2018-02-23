<?php
  session_start();
 ?>
<div class="container">
  <div class="row">
        <div class="col-md-6">
          <img src="<?php echo $_SESSION['sess_profImg']; ?>" alt="Profile Pic">
          <?php
            echo $_SESSION['sess_username'];
          ?>
        </div>
        <div class="col-md-6">

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6"></div>
    </div>
</div>
