<?php
include('ip2locationlite.class.php');
 
//Load the class
$ipLite = new ip2location_lite;
$ipLite->setKey('621f736b28c722fd141ff36e2354dcb291eebb8d33cf0a4a9225653ff6796c6b');
 
//Get errors and locations
$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
$errors = $ipLite->getError();
 
/*//Getting the result
echo "<p>\n";
echo "<strong>First result</strong><br />\n";
if (!empty($locations) && is_array($locations)) {
  foreach ($locations as $field => $val) {
    echo $field . ' : ' . $val . "<br />\n";
  }
}
echo "</p>\n";
 
//Show errors
echo "<p>\n";
echo "<strong>Dump of all errors</strong><br />\n";
if (!empty($errors) && is_array($errors)) {
  foreach ($errors as $error) {
    echo var_dump($error) . "<br /><br />\n";
  }
} else {
  echo "No errors" . "<br />\n";
}
echo "</p>\n";*/


/******************************************
First result
statusCode : OK
statusMessage : 
ipAddress : ::1
countryCode : -
countryName : -
regionName : -
cityName : -
zipCode : -
latitude : 0
longitude : 0
timeZone : -
Dump of all errors
No errors
****************************************/
//echo $locations['ipAddress'];
?>