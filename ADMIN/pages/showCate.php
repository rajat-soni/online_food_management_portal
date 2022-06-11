<?php require "adminHeader.php";
	 require '../dbConfig/dbConfig.php';
    //  require '../customFunction/function.php';?>
    <div id="page-wrapper">
        <?php
     
    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['cate_id']) && $_GET['cate_id']>0){
        $type = $_GET['type'];
        $id = $_GET['cate_id'];
        $sql = " DELETE FROM `or_category_tbl` WHERE `category_id` = '$id' ";
        $mysql = $conn->query($sql) or die('error in sql');
        if($mysql->num_rows > 0){
            redirect('showCate.php');
        }
    
  
    } 
    // if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['cate_id']) && $_GET['cate_id']>0){

    //     $type = $_GET['type'];
    //     $id = $_GET['cate_id'];
    //     $sql = " DELETE FROM `or_category_tbl` WHERE `category_id` = '$id' ";
    //     $mysql = $conn->query($sql) or die('error in sql');
    //     if($check = $mysql->num_rows > 0){
    //        redirect('showCate.php');
    //     }
    // }
    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['category_id']) && $_GET['category_id']>0){
    
        $type = $_GET['type'];
        $cate_id = $_GET['category_id'];
        if($type == "active" || $type == "deactive"){
           
           $status = 1;
            if($type == "deactive"){
                $status = 0; 
            }
            echo $status;
               $sql = " UPDATE `or_category_tbl` SET `category_status`= '$status'  WHERE `category_id` = '$cate_id' ";
            $mysql = $conn->query($sql) or die("sql not working");
          redirect('showCate.php');
        }else{
            echo "type not get";
        }
    }


    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['cate_id']) && $_GET['cate_id']>0){
        $type = $_GET['type'];
        $id = $_GET['cate_id'];
        $sql = " SELECT * FROM  `or_category_tbl` WHERE `category_id` = '$id' ";
        $mysql = $conn->query($sql) or die('error in sql');
        if($mysql->num_rows > 0){
            ?>
            
            <?php }}
    
  


$query = "SELECT * FROM `or_category_tbl` order by `order_number` ";
$mysql = $conn->query($query) or die('error in sql table');
$row = array();
?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Category Master</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                               Category  Table
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Cate_name</th>
                                                    <th>Order_no</th>
                                                    <!-- <th>Cate_status</th> -->
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
                                                    <td style= "width:30%;"><?php echo $row['category_name'];?></td>
                                                    <td style= "width:30%;"><?php echo $row['order_number'];?></td>
                                                    
                                                    <td class="center " style= "width:20%;"><a href= "?cate_id=<?php echo $row['category_id'];?>&type= delete"><i class="fa fa-fw" aria-hidden="true" title="Copy to use close" style = "font-size:20px;"></i></a> &nbsp;

                                                  <a href= "?cate_id=<?php echo $row['category_id']?>&type = edit"><i class="fa fa-fw" aria-hidden="true" title="Copy to use pencil-square-o" style = "font-size:20px;"></i></a> &nbsp;
                                                  
                                                   <?php if($row['category_status'] == 1){?>

                                                   <a href= "?category_id=<?php echo $row['category_id'];?>&type=deactive"><i class="fa fa-fw" aria-hidden="true" title="Make it deactive" style="font-size:20px;"></i></a> &nbsp;
                                                  
                                                  <?php }else{?>
                                                   <a href= "?category_id=<?php echo $row['category_id'];?>&type=active" class=""><i class="fa fa-fw" aria-hidden="true" title="Make is active" style="font-size:20px;" ></i></a></span>
                                                  
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