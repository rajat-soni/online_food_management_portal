<?php require "adminHeader.php";
	 require '../dbConfig/dbConfig.php';
    ?>
    <div id="page-wrapper">
        <?php
     
    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['user_id']) && $_GET['user_id'] > 0 ){
        $type = $_GET['type'];
        $id = $_GET['user_id'];
        $row = array();
        $sql = " DELETE FROM `or_user_tbl` WHERE `user_id` = '$id' ";
        $mysql = $conn->query($sql) or die('error in sql delet table');
        if($mysql->num_rows > 0){
            redirect('showUser.php');
        }
    
  
    } 
 
    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['users_id']) && $_GET['users_id']>0){
    
        $type = $_GET['type'];
        $id = $_GET['users_id'];
        if($type == "active" || $type == "deactive"){
           
           $status = 1;
            if($type == "deactive"){
                $status = 0; 
            }
               $updatesql = " UPDATE `or_user_tbl` SET `user_status`= '$status'  WHERE `user_id` = '$id' ";
            $mysql = $conn->query($updatesql) or die("sql not working activate and deactivate");
            redirect('showUser.php');
        }else{
            echo "type not get";
        }
    }


    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['user_id']) && $_GET['user_id']>0){
        $type = $_GET['type'];
        $id = $_GET['user_id'];
        $sql = " SELECT * FROM  `or_user_tbl` WHERE `user_id` = '$id' ";
        $mysql = $conn->query($sql) or die('error in sql in feaching data');
        if($mysql->num_rows > 0){
            
        }
    }
    
  


$query = " SELECT * FROM  `or_user_tbl` ";
$mysql = $conn->query($query) or die('error in sql table fetch data');
$row = array();

?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">User Master &nbsp; &nbsp;<span style="float:right; background-color:light;"><a href="addBoys.php" class="btn btn-lg btn-primary">Add  User</a><span></h1>
                        </div>
                      
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                            Delivery Boys Master
                                </div>
                                
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Password</th> 
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($check = $mysql->num_rows>0){
                                                    $i = 1;
                                                    while($result = $mysql->fetch_assoc()){ 
                                                        $row = $result;?>
                                                       
                                                <tr class="odd gradeX">
                                                <td style= "width:10%;"><?php echo $i;?></td>
                                                    <td style= "width:20%;"><?php echo $row['user_name'];?></td>
                                                    <td style= "width:20%;"><?php echo $row['user_mobile'];?></td>
                                                    <td style= "width:20%;"><?php echo $row['user_email'];?></td>
                                                    <td style= "width:15%;"><?php echo $row['user_password'];?></td>
                                                    
                                                    <td class="center " style= "width:40%;"><a href= "addUser.php?user_id=<?php echo $row['user_id'];?>"><i class="fa fa-fw" aria-hidden="true" title="Copy to use close" style = "font-size:20px;"></i></a> &nbsp;

                                                  <a href= "addUser.php?user_id=<?php echo $row['user_id'];?>"><i class="fa fa-fw" aria-hidden="true" title="Copy to use pencil-square-o" style = "font-size:20px;"></i></a> &nbsp;
                                                  
                                                   <?php if($row['user_status'] == 1){?>

                                                   <a href= "?user_id=<?php echo $row['user_id'];?>&type=deactive"><i class="fa fa-fw" aria-hidden="true" title="Make it deactive" style="font-size:20px;"></i></a> &nbsp;
                                                  
                                                  <?php }else{?>
                                                   <a href= "?user_id=<?php echo $row['user_id'];?>&type=active" class=""><i class="fa fa-fw" aria-hidden="true" title="Make is active" style="font-size:20px;" ></i></a></span>
                                                  
                                                <?php }?>
                                                </td>
                                                    
                                                    </tr>
                                               
                                                <?php  $i++;  } ?>
                                                <?php }else{ echo "No record found";} ?>
                                                   
                                            </tbody>
                                            

                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                    
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
<?php require "adminFooter.php";?>