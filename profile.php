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
    <hr>
    <div class="row" style="height:350px;width:1200px;">
        <div class="col-md-12" style="height:100%;width:100%;">
            <?php
               include 'googleMaps/map.php';
             ?>

        </div>

        <div class="col-md-6"></div>
    </div>
</div>
