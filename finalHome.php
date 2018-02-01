
<div class="forum">
    <h2 style="color:#45a29e;margin-left:5%;">Favorite Movies</h2>
  <?php
        $servername = "localhost";
        $username = "root";
        $password = "mysql";
        $databaseName = "projectData";


      $connection = new mysqli($servername, $username, $password, $databaseName);

      if ($connection->connect_error){
        die("connection failed: ".$connection->connect_error);
      }

      $query = "SELECT * FROM `entry`";
      $result = $connection->query($query);

      $data = array();

      if ($result){
      while($row = $result->fetch_assoc()){
        $data[] = $row;
      }
      $result->free();
      $connection->close();
}

if (!empty($data)) {

        ?>
        <table class="table">
          <tr class="headerT">
            <th>Movie</th>
            <th>Name</th>
            <th>Date</th>
            <th>Comment</th>
          </tr>
          <?php
          $timesLooped = floor(count($data) / 5);
          $remainder = count($data) % 5;

          if ($remainder == 0){
            $maxSub = $timesLooped;
          } else {
            $maxSub = $timesLooped + 1;
          }

          $subToUse = $_GET['subsection'];

          if ($subToUse < 1 || !is_numeric($subToUse)){
            $subToUse = 1;
          } else if ($subToUse > $maxSub){
            $subToUse = $maxSub;
          }

          $begin = ($subToUse * 5 - 4);

          if ($subToUse >= $maxSub && $remainder !== 0){
            $end = $begin + $remainder - 1;
          } else {
            $end = $begin + 4;
          }

            for ($i = $begin; $i < $end + 1 ; $i++){
              echo '<tr class="tData">'.PHP_EOL;
                foreach ($data[$i-1] as $column){
                  echo '<td class="Col">'.PHP_EOL;
                  echo $column.PHP_EOL;
                  echo '</td>'.PHP_EOL;
                }
              echo '</tr>'.PHP_EOL;
            }
    ?>

  </table>
<br>
  <?php
  if ($remainder > 0) {
    $subsections = $timesLooped + 1;
  } else {
    $subsections = $timesLooped;
  }
  ?>
  <div style="margin-left:5%">
    <?php

  for ($i = 0; $i < $timesLooped; $i ++){
    $begin = $i * 5 + 1;
    $end = $begin + 4;
    $sub = $i + 1;
    echo "<a  href=\"index.php?subsection=$sub\">";
    echo $begin . ' - ' . $end;
    echo '</a>';
    echo ' | ';
  }

  if ($remainder > 1){
    $sub = $timesLooped + 1;
    echo "<a  href=\"index.php?subsection=$sub\">";
    echo count($data) - $remainder + 1 . ' - ' . count($data);
    echo '</a>';
  } else if($remainder == 1) {
    echo "<a  href=\"index.php?subsection=$subsections\">";
    echo count($data);
    echo '</a>';
  }

} else{
  echo 'There is no posts yet! Please post something';
}
   ?>
 </div>

<div style=" <?php session_start(); if ( (($_SESSION['logged_in']) == False))echo "display:none;"  ?>" class="entry">
   <a href="./index.php?page=finalEntry">New Entry</a>
 </div>
</div>
