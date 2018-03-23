<?php
$url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=theaters+in+Philadelphia&key=AIzaSyCJcbdw_nWmu-ZogZc0TbOPDWDKVDCd3MQ";

function get_json( $url )
{
    //found some options on stack overflow
    $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING       => "",
        CURLOPT_AUTOREFERER    => true,
        CURLOPT_CONNECTTIMEOUT => 120,
        CURLOPT_TIMEOUT        => 120,
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_SSL_VERIFYPEER => false
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);

    return ($result);
}

$urlX = get_json($url);


$jsonD = json_decode($urlX,true);

$server = "localhost";
$username = "root";
$password = "mysql";
$databaseName = "projectData";

$connection = new mysqli($server,$username,$password,$databaseName);

$var = $jsonD['results'];

$name = "";
$address = "";
for ($i=0; $i < 20; $i++) {
  $name = $name."'".$var[$i]{'name'}."'".",";
 }

for ($i=0; $i < 20; $i++) {
  $address = $address."'".$var[$i]{'formatted_address'}."'".",";
 }

 $name = rtrim($name, ",");
 $address = rtrim($address, ",");

 $insertSQL = "INSERT INTO cap (Name,Address) VALUES ('$name','$address')";

 if($connection->query($insertSQL) === TRUE){
   echo "Success!";
       }else{
   echo "Error: ".$insertSQL."<br>".$connection->error;
       }
 $connection->close();
 ?>
