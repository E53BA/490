<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="single-card">
            <div class="card">

                <h1 class="card-title">Login</h1>

                <form action="" method="post">
                    <label>Username:</label>
                    <input type="text" name="username">

                    <label>Password:</label>
                    <input type="password" name="password">

                    <button type="submit">Login</button>

					<?php
						if (!empty($_POST)) {
							$data = array(
							"username" => $_POST["username"],
							"password" => $_POST["password"]
							);

							$url = 'https://afsacess4.njit.edu/~sk2662/CS490Alpha/testmiddle.php';
							$ch = curl_init($url);
							$postData = http_build_query($data);
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							$response = json_decode(curl_exec($ch), true);
							curl_close($ch);

							if($response["custom"]) {
								echo '<p class="card-content">Custom logged in.</p>';
							} else {
								echo '<p class="card-content">Custom failed to login.</p>';
							}
							if($response["njit"]) {
								echo '<p class="card-content">NJIT logged in.</p>';
							} else {
								echo '<p class="card-content">NJIT failed to login.</p>';
							}
						}
					?>
                </form>
            </div>
        </div>
    </body>
</html>
