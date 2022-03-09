
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
						$comment = $_POST['comment'];
					    $status = $_POST['status'];
						$exam_no = $_POST['exam_no'];
						$roll_no = $_POST['roll_no'];
                        $total_marks = $_POST['total_marks'];
						
				
					switch($_GET['action']){
						case 'add':			
                            $chquery  = 'Select * From result_status where exam_no ='.$exam_no.' and roll_no ='.$roll_no;
                            $chres = mysqli_query($db,$chquery);
                            if(mysqli_num_rows($chres)>0){
                                ?>
                                <script type="text/javascript">
                                alert('Status already exist');
                                window.location = "resultView.php?exam=<?php echo $exam_no;?>&roll=<?php echo $roll_no?>";
                                </script>
                            <?php
                            }
                            else{
                                $query = "INSERT INTO result_status
                            (id, exam_no, roll_no, total_marks, comment, status)
                            VALUES (Null,'".$exam_no."','".$roll_no."','".$total_marks."','".$comment."','".$status."')";
							print_r($query);	
                                mysqli_query($db,$query)or die ('Error in updating Database');
                            }
							
						break;
									
						}
				?>
    	<script type="text/javascript">
			alert("Result Status successfully added.");
			window.location = "resultView.php?exam=<?php echo $exam_no;?>&roll=<?php echo $roll_no?>";
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

