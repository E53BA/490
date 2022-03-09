<?php

Class Controller{
	public function getExams(){
		$db = $this->connection();
		$query = 'SELECT * FROM exams group by exam_no';
	    $result = mysqli_query($db, $query) or die (mysqli_error($db));
	    $emparray = array();
		while ($row = mysqli_fetch_assoc($result)) {
		    $emparray[] = $row;
		}
	    $final_data = json_encode($emparray);
	    
	    return $final_data ;
	}

	public function getTotalQuestions($exam_no) {
		$db = $this->connection();
		$count_query = 'SELECT Count(*) as count FROM exams where exam_no = '.$exam_no ;
        $count_result = mysqli_query($db, $count_query) or die (mysqli_error($db));
	    $emparray = array();
		while ($row = mysqli_fetch_assoc($count_result)) {
		    $emparray[] = $row;
		}
	    $final_data = json_encode($emparray);
	    $countQuestions = json_decode($final_data);
	    
	    return $countQuestions ;
	}

	public function getExamById($exam_no) {
		$db = $this->connection();
		$count_query = 'SELECT * FROM exams where exam_no = '.$exam_no ;
        $count_result = mysqli_query($db, $count_query) or die (mysqli_error($db));
	    $emparray = array();
		while ($row = mysqli_fetch_assoc($count_result)) {
		    $emparray[] = $row;
		}
	    $final_data = json_encode($emparray);
	    
	    
	    return $final_data ;
	}

	public function previewExam($exam_no) {
		$db = $this->connection();
		$query = 'SELECT * FROM exams
                        LEFT JOIN question_bank
                        ON exams.question_id = question_bank.id where exams.exam_no = '.$exam_no ;
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
	    $emparray = array();
		while ($row = mysqli_fetch_assoc($result)) {
		    $emparray[] = $row;
		}
	    $final_data = json_encode($emparray);
	    
	    
	    return $final_data ;
	}
	
	public function questionList(){
		$db = $this->connection();
		$query = 'SELECT * FROM question_bank';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        $emparray = array();
		while ($row = mysqli_fetch_assoc($result)) {
		    $emparray[] = $row;
		}
	    $final_data = json_encode($emparray);
	    
	    return $final_data ;
	}

	public function resultList(){
		$db = $this->connection();
		 $query = 'SELECT t1.exam_no,t2.id,t2.roll_no, t2.name FROM exams as t1 INNER JOIN exams_result as t2 ON t1.exam_no = t2.exam_no group by t1.exam_no';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        $emparray = array();
		while ($row = mysqli_fetch_assoc($result)) {
		    $emparray[] = $row;
		}
	    $final_data = json_encode($emparray);
	    
	    return $final_data ;
	}

	public function studentResultList($roll_no){
		$db = $this->connection();
		$emparray = array();
		if(!$roll_no){
			return $emparray ;
		} else{
				 $query = 'SELECT t1.exam_no,t2.id,t2.roll_no, t2.name FROM exams as t1 INNER JOIN exams_result as t2 ON t1.exam_no = t2.exam_no where t2.roll_no = '.$roll_no.' group by t1.exam_no ' ;
		
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
		while ($row = mysqli_fetch_assoc($result)) {
		    $emparray[] = $row;
		}
	    $final_data = json_encode($emparray);
	    
	    return $final_data ;
		}
	}
	
	public function submitExam($exam_no, $question_id, $mark){
			$db = $this->connection();
			
			
			$query = "INSERT INTO exams
                            (id, exam_no, question_id, mark)
                            VALUES (Null,'".$exam_no."','".$question_id."','".$mark."')";

    		if(mysqli_query($db,$query)){
    				return true;
    		} else{
    			die ('Error in updating Database');
    			return false;
    		}
	}

	public function submitQuestion(Request $request){
			$db = $this->connection();
			$question = $this->request('question');
			$option1 = $this->request('option1');
			$option2 = $this->request('option2');
			$option3 = $this->request('option3');
			$option4 = $this->request('option4');
			$answer = $this->request('answer');
			
			$query = "INSERT INTO question_bank
                            (id, question, option1, option2, option3, option4, answer)
                            VALUES (Null,'".$question."','".$option1."','".$option2."','".$option3."','".$option4."','".$answer."')";

    		if(mysqli_query($db,$query)){
    				return true;
    		} else{
    			die ('Error in updating Database');
    			return false;
    		}
	}

	public function submitTakeExam($exam_no, $roll_no, $name, $answer, $question_id, $mark){
			$db = $this->connection();
			
			$query = "INSERT INTO exams_result
                                (id, exam_no, roll_no, name, user_answer, question_id, mark)
                                VALUES (Null,'".$exam_no."','".$roll_no."','".$name."','".$answer."','".$question_id."','".$mark."')";

    		if(mysqli_query($db,$query)){
    				return true;
    		} else{
    			die ('Error in updating Database');
    			return false;
    		}
	}

	public function updateQuestion(Request $request){
			$db = $this->connection();
			$id = $this->request('id');
			$question = $this->request('question');
			$option1 = $this->request('option1');
			$option2 = $this->request('option2');
			$option3 = $this->request('option3');
			$option4 = $this->request('option4');
			$answer = $this->request('answer');
			
			$query = 'UPDATE question_bank set question ="'.$question.'",
					option1 ="'.$option1.'", option2="'.$option2.'",
					option3="'.$option3.'",option4="'.$option4.'", 
					answer="'.$answer.'" WHERE
					id ="'.$id.'"';

    		if(mysqli_query($db,$query)){
    				return true;
    		} else{
    			die ('Error in updating Database');
    			return false;
    		}
	}

	public function resultView($exam_no, $roll_no){
		$db = $this->connection();
		$query = 'SELECT * FROM exams_result as t1 INNER JOIN question_bank as t2 ON t1.question_id = t2.id where exam_no ='.$exam_no.' and roll_no ='.$roll_no;
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        $emparray = array();
		while ($row = mysqli_fetch_assoc($result)) {
		    $emparray[] = $row;
		}
	    $final_data = json_encode($emparray);
	    
	    return $final_data ;
	}

	public function delete($type, $id , $exam_no){
		$db = $this->connection();
		switch($type){
			case 'question':
					$query = 'DELETE FROM question_bank
							WHERE
							id = ' . $id;
					if(mysqli_query($db,$query)){
		    				return true;
		    		} else{
		    			die ('Error in updating Database');
		    			return false;
		    		}
			case 'exam':
					$query = 'DELETE FROM exams
							WHERE
							exam_no = ' . $exam_no;
					if(mysqli_query($db,$query)){
    				return true;
    				} else{
    					die ('Error in updating Database');
    						return false;
    				}
		}
	}

	public function connection(){
		$db = mysqli_connect('localhost', 'root', '') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'exam_portal' ) or die(mysqli_error($db));
         return $db;
	}
}

?>