<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://afsaccess4.njit.edu/~sk2662/CS490Alpha/testmiddle.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(
        array(
            "username" => $_POST["username"],
            "password" => $_POST["password"],
        )
    )
);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$json = json_decode($response, true);

if (empty($response)) {
	echo "No response :(<br>";
} else {
    // Process the response
    switch ($json["type"]) {
        case "student":
            echo "<h1>Welcome, student!</h1><br>";
            break;
        case "teacher":
            echo "<h1>Welcome, teacher!</h1><br>";
            break;
        default:
            echo '<form action="../front-end/login.php" method="POST"> Username: <br><input type="text" name="username"><br> Password: <br><input type="text" name="password"><br> <input type="submit"> </form>';
            break;
    }
}
curl_close($ch);


?>
