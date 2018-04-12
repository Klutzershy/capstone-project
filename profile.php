<?php
  session_start();
 ?>
<div class="container">
  <div class="row">
        <div class="col-md-6">
          <h4><?php echo $_SESSION['sess_username'];?></h4>
          <small><cite><?php echo $_SESSION['sess_location']; ?> </cite></small>
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
