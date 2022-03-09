<!DOCTYPE html>
<html lang="en">


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
<?php 
$query = 'SELECT * FROM question_bank
              WHERE
              id ='.$_GET['id'];
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
              while($row = mysqli_fetch_array($result))
              {   
                $zz= $row['id'];
                $i= $row['question'];
                $a=$row['option1'];
                $b=$row['option2'];
                $c=$row['option3'];
                $d=$row['option4'];
                $e=$row['answer'];
             
              }
              
              $id = $_GET['id'];
         
?>

             <div class="col-lg-12">
                  <h2>Edit Question</h2>
                      <div class="col-lg-6">

                        <form role="form" method="post" action="edit1.php">
                            
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $zz; ?>" />
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Question" name="question" value="<?php echo $i; ?>">
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Option1" name="option1" value="<?php echo $a; ?>">
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Option2" name="option2" value="<?php echo $b; ?>">
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Option3" name="option3" value="<?php echo $c; ?>">
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Option4" name="option4" value="<?php echo $d; ?>">
                            </div> 
                            <div class="form-group">
                             <label>Select Answer</label>
                             <select name="answer">
                               <?php
                                $optionArr = ['option1', 'option2', 'option3', 'option4'];
                                $selected = '';
                                foreach($optionArr as $option){
                                  if($option == $e){
                                    $selected = 'selected';
                                  }else{
                                    $selected = '';
                                  }
                                  ?><option value=<?php echo $option.'  '."$selected" ; ?>><?php echo $option;?></option>
                              <?php  }
                               ?>
                                  
                                  
                              </select>
                            </div>  
                            <button type="submit" class="btn btn-default">Update Record</button>
                         


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

