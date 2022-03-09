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
                        List of Exams
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->


             <div class="col-lg-12">
                        <a href="addexam.php?action=add" type="button" class="btn btn-xs btn-info">Add New</a>
                                
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Exam #</th>
                                        <th>Total Questions</th>
                                        <th>Total Marks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php                  
                $query = 'SELECT * FROM exams group by exam_no';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                        while ($row = mysqli_fetch_assoc($result)) {
                                             
                            echo '<tr>';
                            echo '<td>'. $row['exam_no'].'</td>';
                        $count_query = 'SELECT Count(*) as count FROM exams where exam_no = '.$row['exam_no'] ;
                        $count_result = mysqli_query($db, $count_query) or die (mysqli_error($db));
                  
                        while ($total_questions = mysqli_fetch_assoc($count_result)) {
                            echo '<td>'. $total_questions['count'].'</td>';
                        }
                        $mark_query = 'SELECT * FROM exams where exam_no = '.$row['exam_no'];
                        $mark_result = mysqli_query($db, $mark_query) or die (mysqli_error($db));
                        $total_marks = 0;
                        while ($mark = mysqli_fetch_assoc($mark_result)) {
                            $total_marks = $total_marks + $mark['mark']; 
                        }
                            echo '<td>'. $total_marks.'</td>';
                            echo '<td>';
                            echo ' <a  type="button" class="btn btn-xs btn-warning" href="addexam.php?action=add&exam='.$row['exam_no'] . '"> EDIT </a> ';
                            // echo ' <a  type="button" class="btn btn-xs btn-danger" href="del.php?type=exam&delete&exam_no=' . $row['exam_no'] . '">DELETE </a> ';
                            echo ' <a  type="button" class="btn btn-xs btn-warning" href="take_exam.php?exam=' . $row['exam_no'] . '">TAKE Exam </a> </td>';
                            echo '</tr> ';
                }
            ?> 
                                    
                                </tbody>
                            </table>
                        </div>
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
