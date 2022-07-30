<?php require "adminHeader.php";
	 require '../dbConfig/dbConfig.php';
    //  require 'constant.php';
     error_reporting();
    //  require '../customFunction/function.php';?>
    
    <div id="page-wrapper">
        <?php
        //print_r(IMAGE_PATH);
        // getErorrR($_SERVER);
     
    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['coupan_id']) && $_GET['coupan_id'] > 0 ){
        $type = $_GET['type'];
        $id = $_GET['coupan_id'];
        
         $sql = "DELETE FROM `or_coupan_tbl` WHERE `coupan_id` = '$id' ";
        $delMysql = $conn->query($sql) or die("error in sql table");
        if($delMysql->num_rows > 0){
            redirect('showCoupan.php');
        }
    } 
 
    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['coupans_id']) && $_GET['coupans_id']>0){
    
        $type = $_GET['type'];
        $coupan_id = $_GET['coupans_id'];
        if($type == "active" || $type == "deactive"){
           
           $status = 1;
            if($type == "deactive"){
                $status = 0; 
            }
               $updatesql = " UPDATE `or_coupan_tbl` SET `coupan_status`= '$status'  WHERE `coupan_id` = '$coupan_id' ";
            $mysql = $conn->query($updatesql) or die("update not working");
            redirect('showCoupan.php');
        }else{
            echo "type not get";
        }
    }


    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['coupan_id']) && $_GET['coupan_id']>0){
        $type = $_GET['type'];
        $id = $_GET['coupan_id'];
        $sql = " SELECT * FROM  `or_coupan_tbl` WHERE `coupan_id` = '$id' ";
        $mysql = $conn->query($sql) or die('error in select sql');
        if($mysql->num_rows > 0){
            
        }
    }
    
$query = " SELECT * FROM  `or_coupan_tbl`";
$mysql = $conn->query($query) or die('error in select sql');
$row = array();

?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Coupan Master&nbsp; &nbsp;<span style="float:right; background-color:light;"><a href="addCoupan.php" class="btn btn-lg btn-primary">Add Coupan</a><span></h1>
                        </div>
                      
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                            Coupan Master
                                </div>
                                
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>coupan code</th>
                                                    <th>coupan_type</th>
                                                    <th>coupan_value</th>
                                                    <th>coupan_min_value</th>
                                                    <th>Expired on</th>
                                                    <th>status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($check = $mysql->num_rows>0){
                                                    $i = 1;
                                                    while($result = $mysql->fetch_assoc()){ 
                                                        $row = $result;
                                                        //getErorrR($row);
                                                        // $images = $row['dish_image'];
                                                ?>
                                                       
                                                <tr class="odd gradeX">
                                                <td style= "width:10%;"><?php echo $i;?></td>
                                                    <td style= "width:10%;"><?php echo $row['coupan_code'];?></td>
                                                    <td style= "width:10%;"><?php echo $row['coupan_type'];?></td>
                                                    <td style= "width:10%;"><?php echo $row['coupan_value'];?></td>
                                                    <td style= "width:10%;"><?php echo $row['cart_min_value'];?></td>
                                                    <td style= "width:20%;"><?php echo $row['expired_on'];?></td>
                                                    <td style= "width:10%;"><?php echo $row['coupan_status'];?></td>
                                                    
                                                    
                                                    <td class="center " style= "width:50%;"><a href="?coupan_id=<?php echo $row['coupan_id'];?>&type= delete"><i class="fa fa-fw" aria-hidden="true" title="Copy to use trash" style="font-size:20px;"></i></a> &nbsp;

                                                  <a href= "addCoupan.php?coupan_id=<?php echo $row['coupan_id'];?>"><i class="fa fa-fw" aria-hidden="true" title="Copy to use pencil-square-o" style = "font-size:20px;"></i></a> &nbsp;
                                                  
                                                   <?php if($row['coupan_status'] == 1){?>

                                                   <a href= "?coupans_id=<?php echo $row['coupan_id'];?>&type=deactive"><i class="fa fa-fw" aria-hidden="true" title="Make it deactive" style="font-size:20px;"></i></a> &nbsp;
                                                  
                                                  <?php }else{?>
                                                   <a href = "?coupans_id=<?php echo $row['coupan_id'];?>&type=active" class=""><i class="fa fa-fw" aria-hidden="true" title="Make is active" style="font-size:20px;" ></i></a></span>
                                                  
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