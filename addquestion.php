
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
					    $question_id = $_POST['question'];
						$mark = $_POST['mark'];
				
					switch($_GET['action']){
						case 'add':			
                            $query = "INSERT INTO exams
                            (id, exam_no, question_id, mark)
                            VALUES (Null,'".$exam_no."','".$question_id."','".$mark."')";
								
                                mysqli_query($db,$query)or die ('Error in updating Database');
							
						break;
									
						}
                        
				?>
    	<script type="text/javascript">
			alert("Question successfully added.");
			window.location = "addexam.php?action=add&exam=<?php echo $exam_no?>";
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

