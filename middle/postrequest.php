<?php
$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true); // decoding received JSON to array
$UCID="none";$Password="none";
if(isset($response['UCID'])) $UCID = $response['UCID'];
if(isset($response['Password'])) $Password = $response['Password'];

$res_proejct=loginBk($UCID,$Password));
$res_njit=loginWelcomePg($UCID,$Password);
print "<center><h2>".$res_proejct.' '.$res_njit."</h2></center>";

// curl backend
function loginBk($UCID,$Password){
    $data = array('UCID' => $UCID,'Password' =>$Password);
    $url = "https://afsacess4.njit.edu/~rv356/public_html/CS490alpha/alpha.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close ($ch);
    return $response;
}
// curl Frontend
function loginWelcomePg($UCID,$Password){
    $url = "https://afsacess4.njit.edu/~sk2662/CS490Alpha/Login.html";
    $data= array("UCID" => $UCID,"Password" =>$Password,"uuid" => "0xACA021");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    curl_close ($ch);

}
?>
