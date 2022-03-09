
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
                  <h2>Add new Question</h2>
                      <div class="col-lg-6">

                        <form role="form" method="post" action="transac.php?action=add">
                            
                            <div class="form-group">
                              <input class="form-control" placeholder="Question" name="question" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Option 1" name="option1" required>
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Option 2" name="option2" required>
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Option 3" name="option3" required>
                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Option 4" name="option4" required>
                            </div> 
                            <label> Answer</label>
                            <div class="form-group">
                              <select name="answer" required>
                                  <option value="option1">option1</option>
                                  <option value="option2">option2</option>
                                  <option value="option3">option3</option>
                                  <option value="option4">option4</option>
                              </select>
                            </div> 
                            
                            <button type="submit" class="btn btn-default">Save Question</button>
                            <button type="reset" class="btn btn-default">Clear</button>


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

