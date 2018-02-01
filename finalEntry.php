<div class="forum">


             <?php
				session_start();
               function checkMovie($movie){

                 $movie = trim($movie);

                 if(empty($movie)){
                   return false;
                 }
                 return true;
               }

               function checkComment($comment){

                 $comment = trim($comment);
                 $comment = htmlspecialchars($comment);

                 if(empty($comment)){
                   return false;
                 }
                 return true;
               }


               $validMovie = $validComment = $validInput = false;

               if($_SERVER['REQUEST_METHOD'] == 'POST'){

                 $movie = $_POST['movie'];
				         $name = $_SESSION['sess_username'];
                 $date = getdate();
                 $date = $date[mon]."/".$date[mday]."/".$date[year];
                 $comment = $_POST['comment'];

                 $validMovie = checkMovie($movie);
                 $validComment = checkComment($comment);


                 $validInput = $validComment && $validMovie ;
               }

               if ($validInput){

                 $server = "localhost";
                 $username = "root";
                 $password = "mysql";
                 $databaseName = "projectData";

                 $connection = new mysqli($server,$username,$password,$databaseName);

                 if($connection->connect_error){
                   die("connection failed:". $connection->connect_error);
                 }


                 $insertSQL = "INSERT INTO entry (movie,name,edate,comment) VALUES ('$movie','$name','$date',\"$comment\")";


                 if($connection->query($insertSQL) === TRUE){
					header('Location: ./index.php?page=main');

                 echo "Success: We will submit the following information<br>";
                 echo $movie."<br>";
                 echo $name."<br>";
                 echo $date."<br>";
                 echo $comment."<br>";
               }else{
                 echo "Error: ".$insertSQL."<br/>".$connection->error;
               }
               $connection->close();
             }else{


                 ?>

              <h2 style="color:red;margin-left:5%;">Let us know!</h2>
<div class="form">
             <form method="POST" action="./finalEntry.php" name="entry" id="entry">
               Movie: <input type="text" name="movie"><span style="color:red"> * Movie is Required</span><br><br>
               Comment: <textarea form="entry" name="comment">Type your comment here</textarea><span style="color:red"> * Comment is Required</span><br><br>
               <input class="entryButton" type="submit" name="submit" value="Submit">
               <input class="entryButton" type="reset" name="reset" value="Reset" onClick="resetForm()">
             </form>
</div>
             <?php
             }
             ?>


</div>
