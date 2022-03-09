<?php
       
       include('connection.php');
       include('header.php');
       if(!isset($_GET['exam']) || !isset($_GET['roll'])){
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

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                        Result (Enrollment #: <?php echo $_GET['roll']?>)
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->


                <div class="col-lg-12">
                            
                    <?php      
                        $count = 1;
                        $total_marks = 0;
                        $status = '' ;
                        $mark = 0 ;
                        $query = 'SELECT * FROM exams_result as t1 INNER JOIN question_bank as t2 ON t1.question_id = t2.id where exam_no ='.$_GET['exam'].' and roll_no ='.$_GET['roll'];
                        $result = mysqli_query($db, $query) or die (mysqli_error($db));
                            while ($row = mysqli_fetch_assoc($result)) {?>
                                <p><?php echo $count.'. '?><?php echo $row['question']?> <?php echo ' (mark: '.$row['mark'].')';?></p>
                            <p>a. <?php echo $row['option1']?> &nbsp; b. <?php echo $row['option2']?></p>
                            <p>c. <?php echo $row['option3']?> &nbsp; d. <?php echo $row['option4']?></p>
                            <p>Student Answer: <b><?php echo $row['user_answer'];?></b> &nbsp; Original Answer: <b><?php echo $row[$row['answer']];?></b></p>
                            
                            <?php
                                if($row['user_answer']==$row[$row['answer']]){
                                    $total_marks = $total_marks + $row['mark'];
                                    $status = 'True';
                                    $mark = $row['mark'];
                                } else {
                                    $status = 'False';
                                    $mark = 0 ;
                                }
                            ?>
                            <p>Status: <b><?php echo $status;?></b> &nbsp; Mark: <b><?php echo $mark;?></b></p>
                            <hr>
                    <?php $count++; } ?>

                    <h3>Total Marks: <?php echo $total_marks?></h3>
                    <hr>
                   <?php $status_query = 'SELECT * FROM result_status where exam_no ='.$_GET['exam'].' and roll_no ='.$_GET['roll'];
                        $statusresult = mysqli_query($db, $status_query) or die (mysqli_error($db));
                        if(mysqli_num_rows($statusresult)>0){
                            while ($status = mysqli_fetch_assoc($statusresult)) {?>
                                <p>Comment: <?php echo $status['comment']?></p>
                                <p>Status: <b><?php if($status['status']==1) { echo 'Approved';}else{echo 'Not Approved';}?></b></p>
                            
                            <?php
                           } } else{

                                if(isset($_GET['user'])=='student'){
                                    echo 'NOT Approved yet' ;
                                } else {
                            ?>

                                <form role="form" method="post" action="saveStatus.php?action=add">
                            
                            <div class="form-group">
                              <textarea class="form-control" placeholder="comment" name="comment"></textarea>
                            </div>
                            
                            <div class="form-group">
                              <select name="status">
                                  <option value="1">Approve</option>
                                  <option value="0">Not Approve</option>
                              </select>
                            </div> 
                            <input type="hidden" name="total_marks" value="<?php echo $total_marks?>"/>
                            <input type="hidden" name="exam_no" value="<?php echo $_GET['exam']?>"/>
                            <input type="hidden" name="roll_no" value="<?php echo $_GET['roll']?>"/>
                            <button type="submit" class="btn btn-default">Save</button>
                            


                      </form>  
                           <?php 
                          }  } ?>
                </div>
                    
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


</body>

</html>
