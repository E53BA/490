<?php
//function for sendind curl calls
function curl($url, $data) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$resp = curl_exec($ch);
	curl_close($ch);
	return $resp;
}

//Custom curl data
$dataCust = $_POST;

//login curl data
$dataNjit = array (
"ucid" => $_POST["username"],
"pass" => $_POST["password"]
);

//Send both curl calls
$respCust = curl('https://afsaccess4.njit.edu/~rv356/CS490alpha/alpha.php', $dataCust);

//Build response data
$response = array(
"custom" => json_decode($respCust, true)["login"],
);

//Set resposne data type
header("Content-Type:application/json");
//Send response
echo json_encode($response);
?>
