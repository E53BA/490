
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

                <!-- /.row -->


             <div class="col-lg-12">
             <?php
                            $exam = null;
                            if(isset($_GET['exam'])){
                                $exam = $_GET['exam'];
                                $fieldType = 'readonly';
                            }
                            else{
                                $exam = null;
                                $fieldType = 'required';
                            }
                            ?>
                      <div class="col-lg-6">
                      <h2>Add Question</h2>
                        <form role="form" method="post" action="addquestion.php?action=add">
                           
                            <div class="form-group">
                              <input class="form-control" placeholder="Exam #" name="exam_no" value="<?php echo $exam; ?>" <?php echo $fieldType; ?>>
                            </div>
                            <label>Select Question</label>
                            <div class="form-group">
                            
                              <select name="question" required>
                            <?php
                            $query = 'SELECT id, question FROM question_bank';
                            $result = mysqli_query($db, $query) or die (mysqli_error($db));
                        
                                while ($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['id'] ; ?>><?php echo $row['question'];?></option>             
                            <?php
                            }?>
                              </select>
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Marks" name="mark" required>
                            </div>  
                            <button type="submit" class="btn btn-default">Add Question</button>
                      </form>  
                    </div>
                    <div class="col-lg-6">
                    <h3>Exam Paper Preview</h3>
                    <?php
                    if(isset($_GET['exam'])){
                        $query = 'SELECT * FROM exams
                        LEFT JOIN question_bank
                        ON exams.question_id = question_bank.id where exams.exam_no ='.$_GET['exam'];
                        $result = mysqli_query($db, $query) or die (mysqli_error($db));
                        $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {?>
                            <p><?php echo $count.'. '?><?php echo $row['question']?> <?php echo ' ('.$row['mark'].')';?></p>
                            <p>a. <?php echo $row['option1']?> &nbsp; b. <?php echo $row['option2']?></p>
                            <p>c. <?php echo $row['option3']?> &nbsp; d. <?php echo $row['option4']?></p>
                            <p>Answer: <?php echo $row[$row['answer']];?></p>
                                <hr>
                            
                           <?php $count++; }
                    }
                    
                    ?>
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

