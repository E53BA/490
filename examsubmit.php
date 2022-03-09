
<?php
       
       include('connection.php');
       include('header.php');
       
        ?>   
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php  include('sidebar.php');?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Exams Portal
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->


             <div class="col-lg-12">
                <?php
                        $exam_no = $_POST['exam_no'];
						$roll_no = $_POST['roll_no'];
					    $name = $_POST['name'];
                        $answers['answers'] = [];
                        $answers['question_ids'] = [];
                        $answers['marks'] = [];
                        $query = 'SELECT * FROM exams where exam_no = '.$exam_no;
                        $result = mysqli_query($db, $query) or die (mysqli_error($db));                 
                        while ($row = mysqli_fetch_assoc($result)) {
                            if(isset($_POST['option'.$row['question_id']])){
                                $userAnswer = $_POST['option'.$row['question_id']];
                                $userQuestion = $_POST['question_id'.$row['question_id']];
                                $usermark = $_POST['mark'.$row['question_id']];
                                array_push($answers['answers'],$userAnswer);
                                array_push($answers['question_ids'],$userQuestion);
                                array_push($answers['marks'],$usermark);
                            }
						
                        }
                        
					switch($_GET['action']){
						case 'add':		
                            for($i=0;$i< count($answers['answers']); ){
                                $query = "INSERT INTO exams_result
                                (id, exam_no, roll_no, name, user_answer, question_id, mark)
                                VALUES (Null,'".$exam_no."','".$roll_no."','".$name."','".$answers['answers'][$i]."','".$answers['question_ids'][$i]."','".$answers['marks'][$i]."')";
                                    
                                    mysqli_query($db,$query)or die ('Error in updating Database');
                                    $i++;
                            }
                           
                            
							
						break;
									
						}
                        
				?>
    	<script type="text/javascript">
			alert("Exam successfully submitted.");
			window.location = "exams.php";
		</script>
                    </div>
                </div>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>

