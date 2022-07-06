<?php require "adminHeader.php";
	 require '../dbConfig/dbConfig.php';
     require 'constant.php';
     error_reporting(0);
    //  require '../customFunction/function.php';?>
    
    <div id="page-wrapper">
        <?php
        //print_r(IMAGE_PATH);
        // getErorrR($_SERVER);
     
    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['dish_id']) && $_GET['dish_id'] > 0 ){
        $type = $_GET['type'];
        $id = $_GET['dish_id'];
         $row = array();
        $sql = " DELETE FROM `or_dish_table` WHERE `dish_id` = '$id' ";
        $mysql = $conn->query($sql) or die('error in sql') or die("error in sql table");
        if($mysql->num_rows > 0){
            redirect('showDish.php');
        }
    
  
    } 
 
    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['dishs_id']) && $_GET['dishs_id']>0){
    
        $type = $_GET['type'];
        $dish_id = $_GET['dishs_id'];
        if($type == "active" || $type == "deactive"){
           
           $status = 1;
            if($type == "deactive"){
                $status = 0; 
            }
               $updatesql = " UPDATE `or_dish_table` SET `dish_status`= '$status'  WHERE `dish_id` = '$dish_id' ";
            $mysql = $conn->query($updatesql) or die("sql not working");
            redirect('showDish.php');
        }else{
            echo "type not get";
        }
    }


    if(isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['dish_id']) && $_GET['dish_id']>0){
        $type = $_GET['type'];
        $id = $_GET['dish_id'];
        $sql = " SELECT * FROM  `or_dish_table` WHERE `dish_id` = '$id' ";
        $mysql = $conn->query($sql) or die('error in sql');
        if($mysql->num_rows > 0){
            
        }
    }
    
$query = "SELECT `or_dish_table`.* ,`or_category_tbl`.`category_name` FROM `or_dish_table`,`or_category_tbl` where `or_category_tbl`.`category_id` = `or_dish_table`.`category_id`  ";
$mysql = $conn->query($query) or die('error in sql table');
$row = array();

?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Dish Master&nbsp; &nbsp;<span style="float:right; background-color:light;"><a href="addDish.php" class="btn btn-lg btn-primary">Add Dish</a><span></h1>
                        </div>
                      
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                            Dish Master
                                </div>
                                
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>CategoryName</th>
                                                    <th>DishName</th>
                                                    <th>ShortDiscription</th>
                                                    <th>Discription</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($check = $mysql->num_rows>0){
                                                    $i = 1;
                                                    while($result = $mysql->fetch_assoc()){ 
                                                        $row = $result;
                                                        $images = $row['dish_image'];
                                                ?>
                                                       
                                                <tr class="odd gradeX">
                                                <td style= "width:10%;"><?php echo $i;?></td>
                                                    <td style= "width:10%;"><?php echo $row['category_name'];?></td>
                                                    <td style= "width:10%;"><?php echo $row['dish_name'];?></td>
                                                    <td style= "width:20%;"><?php echo $row['dish_short_details'];?></td>
                                                    <td style= "width:20%;"><?php echo $row['dish_details'];?></td>
                                                    <td style= "width:10%;"><img alt ="" style="width: 60px; height:40px; text-align: center;" src="../images/<?php echo $images?>"></td>
                                                    
                                                    <td class="center " style= "width:50%;"><a href="?dish_id=<?php echo $row['dish_id'];?>&type= delete"><i class="fa fa-fw" aria-hidden="true" title="Copy to use trash" style="font-size:20px;"></i></a> &nbsp;

                                                  <a href= "addDish.php?dish_id=<?php echo $row['dish_id'];?>"><i class="fa fa-fw" aria-hidden="true" title="Copy to use pencil-square-o" style = "font-size:20px;"></i></a> &nbsp;
                                                  
                                                   <?php if($row['dish_status'] == 1){?>

                                                   <a href= "?dishs_id=<?php echo $row['dish_id'];?>&type=deactive"><i class="fa fa-fw" aria-hidden="true" title="Make it deactive" style="font-size:20px;"></i></a> &nbsp;
                                                  
                                                  <?php }else{?>
                                                   <a href= "?dishs_id=<?php echo $row['dish_id'];?>&type=active" class=""><i class="fa fa-fw" aria-hidden="true" title="Make is active" style="font-size:20px;" ></i></a></span>
                                                  
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