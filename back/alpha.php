<?php
include "DB.php";

  $str_json = file_get_contents('php://input');
	$response = json_decode($str_json, true); // decoding received JSON to array

	$UCID="none";$Password="none";

	if(isset($response['UCID'])) $UCID = $response['UCID'];
	if(isset($response['Password'])) $Password = $response['Password'];
//$UCID =
//$Password =


// if there is a user name in the sql hash the
//passowrd from the sql then compare
$sql="SELECT * from UserCS490 where Username like '$UCID' and Password like '$Password'";
$query = $DB->query($sql);
$result=$query->fetchAll();

// SELECT `Role` FROM UserCS490 WHERE `Username`='sk2662'
if ($result == true){
    
    $sql1="SELECT `Role` FROM UserCS490 WHERE `Username`=`$UCID`";
    $query1 = $DB->query($sql1);
    $result1=$query1->fetchAll();
    echo "WELCOME". $result1;
}else{
    echo "Not Acceptable";
}

?>
