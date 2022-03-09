
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
						$question = $_POST['question'];
					    $option1 = $_POST['option1'];
						$option2 = $_POST['option2'];
						$option3 = $_POST['option3'];
						$option4 = $_POST['option4'];
                        $answer = $_POST['answer'];
				
					switch($_GET['action']){
						case 'add':			
                            $query = "INSERT INTO question_bank
                            (id, question, option1, option2, option3, option4, answer)
                            VALUES (Null,'".$question."','".$option1."','".$option2."','".$option3."','".$option4."','".$answer."')";
								
                                mysqli_query($db,$query)or die ('Error in updating Database');
							
						break;
									
						}
				?>
    	<script type="text/javascript">
			alert("Question successfully added.");
			window.location = "index.php";
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

