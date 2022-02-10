<?PHP

      $ch = curl_init(); //initialize curl
      $beurl = "https://afsaccess4.njit.edu/~vs653/AlphaCS490/auth.php"; //url to back end .php
      
      $postdata = file_get_contents('php://input');

      //set up url in curl 
      curl_setopt($ch, CURLOPT_URL, $beurl);
      //setting the return transfer to new
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      //Post in curl
      curl_setopt($ch, CURLOPT_POST, true);
           
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

      $reply = curl_exec($ch);
     
      curl_close($ch);
     
      echo $reply;
?>
