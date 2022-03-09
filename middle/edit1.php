<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
			$id = $_POST['id'];
			$question = $_POST['question'];
		    $option1 = $_POST['option1'];
			$option2 = $_POST['option2'];
			$option3 = $_POST['option3'];
			$option4 = $_POST['option4'];
			$answer = $_POST['answer'];
			
	   include('connection.php');
		
	 			$query = 'UPDATE question_bank set question ="'.$question.'",
					option1 ="'.$option1.'", option2="'.$option2.'",
					option3="'.$option3.'",option4="'.$option4.'", 
					answer="'.$answer.'" WHERE
					id ="'.$id.'"';
					
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
							
?>	
	<script type="text/javascript">
			alert("Update Successfull.");
			window.location = "index.php";
		</script>
 </body>
</html>