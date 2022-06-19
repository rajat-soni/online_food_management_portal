<?php require "adminHeader.php";
	 require '../dbConfig/dbConfig.php';
    //  require '../customFunction/function.php';?>
    <div id="page-wrapper">
        <?php
     
    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['boy_id']) && $_GET['boy_id'] > 0 ){
        $type = $_GET['type'];
        $id = $_GET['boy_id'];
        $row = array();
        $sql = " DELETE FROM `or_delivery_boy_tbl` WHERE `de_boy_id` = '$id' ";
        $mysql = $conn->query($sql) or die('error in sql');
        if($mysql->num_rows > 0){
            redirect('showBoys.php');
        }
    
  
    } 
 
    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['boys_id']) && $_GET['boys_id']>0){
    
        $type = $_GET['type'];
        $boys_id = $_GET['boys_id'];
        if($type == "active" || $type == "deactive"){
           
           $status = 1;
            if($type == "deactive"){
                $status = 0; 
            }
               $updatesql = " UPDATE `or_delivery_boy_tbl` SET `boy_status`= '$status'  WHERE `de_boy_id` = '$boys_id' ";
            $mysql = $conn->query($updatesql) or die("sql not working");
            redirect('showBoys.php');
        }else{
            echo "type not get";
        }
    }


    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['boy_id']) && $_GET['boy_id']>0){
        $type = $_GET['type'];
        $id = $_GET['boy_id'];
        $sql = " SELECT * FROM  `or_delivery_boy_tbl` WHERE `de_boy_id` = '$id' ";
        $mysql = $conn->query($sql) or die('error in sql');
        if($mysql->num_rows > 0){
            
        }
    }
    
  


$query = "SELECT * FROM `or_delivery_boy_tbl` ";
$mysql = $conn->query($query) or die('error in sql table');
$row = array();

?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Deleivery Boys Master &nbsp; &nbsp;<span style="float:right; background-color:light;"><a href="addBoys.php">Add  Delivery Boys</a><span></h1>
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
                                                    <th>Boy_name</th>
                                                    <th>Boy_mobile</th>
                                                    <th>Cate_email</th>
                                                    <!-- <th>Add_on</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($check = $mysql->num_rows>0){
                                                    $i = 1;
                                                    while($result = $mysql->fetch_assoc()){ 
                                                        $row = $result;?>
                                                       
                                                <tr class="odd gradeX">
                                                <td style= "width:20%;"><?php echo $i;?></td>
                                                    <td style= "width:20%;"><?php echo $row['boy_name'];?></td>
                                                    <td style= "width:20%;"><?php echo $row['mobile'];?></td>
                                                    <td style= "width:20%;"><?php echo $row['boy_email'];?></td>
                                                    
                                                    <td class="center " style= "width:40%;"><a href="?boy_id=<?php echo $row['de_boy_id'];?>&type= delete"><i class="fa fa-fw" aria-hidden="true" title="Copy to use close" style = "font-size:20px;"></i></a> &nbsp;

                                                  <a href= "addBoys.php?boys_id=<?php echo $row['de_boy_id'];?>"><i class="fa fa-fw" aria-hidden="true" title="Copy to use pencil-square-o" style = "font-size:20px;"></i></a> &nbsp;
                                                  
                                                   <?php if($row['boy_status'] == 1){?>

                                                   <a href= "?boys_id=<?php echo $row['de_boy_id'];?>&type=deactive"><i class="fa fa-fw" aria-hidden="true" title="Make it deactive" style="font-size:20px;"></i></a> &nbsp;
                                                  
                                                  <?php }else{?>
                                                   <a href= "?boys_id=<?php echo $row['de_boy_id'];?>&type=active" class=""><i class="fa fa-fw" aria-hidden="true" title="Make is active" style="font-size:20px;" ></i></a></span>
                                                  
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