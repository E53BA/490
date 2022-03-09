
<?php
       
       include('connection.php');
       include('header.php');
       if(!isset($_GET['exam'])){
        $url='http://'. $_SERVER['HTTP_HOST'];
     header('Location: '.$url);
    }
        ?>  
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php  include('sidebar.php');?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- /.row -->


             <div class="col-lg-12">
                  
                      <div class="col-lg-6">
                <form role="form" method="post" action="examsubmit.php?action=add">
                      <h2>Information</h2>
                      <input type="hidden" name="exam_no" value="<?php echo $_GET['exam']?>"/>
                      
                      <div class="form-group">
                              <input class="form-control" placeholder="Enrollment #" name="roll_no">
                            </div>
                        <div class="form-group">
                              <input class="form-control" placeholder="Name" name="name">
                            </div>
                            <hr>
                      
                      <?php
                      $mark_query = 'SELECT * FROM exams where exam_no = '.$_GET['exam'];
                        $mark_result = mysqli_query($db, $mark_query) or die (mysqli_error($db));
                        $total_marks = 0;
                        while ($mark = mysqli_fetch_assoc($mark_result)) {
                            $total_marks = $total_marks + $mark['mark']; 
                        }
                        ?>
                        <h2>Questions (Total Marks: <?php echo $total_marks; ?>)</h2>
                        
                        
                        <?php
                    if(isset($_GET['exam'])){
                        $query = 'SELECT * FROM exams
                        LEFT JOIN question_bank
                        ON exams.question_id = question_bank.id where exams.exam_no ='.$_GET['exam'];
                        $result = mysqli_query($db, $query) or die (mysqli_error($db));
                        $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {?>
                            <p><?php echo $count.'. '?><?php echo $row['question']?> <?php echo ' ('.$row['mark'].')';?></p>
                            <input type="radio" name="option<?php echo $row['question_id']?>" value="<?php echo $row['option1']?>">
                            <label for=""><?php echo $row['option1']?></label><br>
                            <input type="radio" name="option<?php echo $row['question_id']?>" value="<?php echo $row['option2']?>">
                            <label for=""><?php echo $row['option2']?></label><br>
                            <input type="radio" name="option<?php echo $row['question_id']?>" value="<?php echo $row['option3']?>">
                            <label for=""><?php echo $row['option3']?></label><br>
                            <input type="radio" name="option<?php echo $row['question_id']?>" value="<?php echo $row['option4']?>">
                            <label for=""><?php echo $row['option4']?></label><br>
                            
                                <hr>
                        <input type="hidden" name="question_id<?php echo $row['question_id']?>" value="<?php echo $row['question_id']?>"/>
                         <input type="hidden" name="mark<?php echo $row['question_id']?>" value="<?php echo $row['mark']?>"/>
                           <?php $count++; }
                    }
                    
                    ?>
                            
                            <button type="submit" class="btn btn-default">Submit</button>

                </form>  
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

