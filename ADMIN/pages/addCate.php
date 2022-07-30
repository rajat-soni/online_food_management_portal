

<?PHP include "adminHeader.php";
require '../dbConfig/dbConfig.php';
// print_r($_SERVER);
$cate_name  = '';
$order_number = '';
$cate_status = '';
$msg = '';

if(isset($_GET['category_id']) && $_GET['category_id'] > 0){
    $cate_id = $_GET['category_id'];
    print_r($cate_id);
    $updateSql = "select * from  `or_category_tbl` where `category_id` = '$cate_id' ";
    $updateMySql = $conn->query($updateSql);
    $fetchSql = $updateMySql->fetch_assoc();
    $cate_name = $fetchSql['category_name'];
    $order_number = $fetchSql['order_number'];
    $cate_status = $fetchSql['category_status'];
    print_r($cate_status);
    
    
}


    if(isset($_POST['submit'])){	
        $cate_name = $conn->real_escape_string($_POST['cate_name']);
        $order_number = $conn->real_escape_string($_POST['order_number']);
        $cate_status = $conn->real_escape_string($_POST['category_status']);
        $add_on = date(`y-m-d h:i:s`);
        if($cate_id == ''){
            $checkSql = "select * from  `or_category_tbl` where `category_name` = '$cate_name' ";
        }else{
            $checkSql = " select * from  `or_category_tbl` where `category_name` = '$cate_name'  and `category_id` != '$cate_id' ";
        }
        $checkMySql = $conn->query($checkSql) or die('error in sql table');
            if($check = $checkMySql->num_rows >0){
                $msg = "Category is already exist";
            }else{
        
               if($cate_id == ''){

                    $cate_sql = " INSERT INTO `or_category_tbl`(`category_name`,`order_number`,`category_status`, `add_on`) VALUES ('$cate_name','$order_number','$cate_status','$add_on')";
                        $mysql = $conn->query($cate_sql);
                }else{

                    echo $updatSql = " UPDATE `or_category_tbl` SET `category_name` = '$cate_name', `order_number`= '$order_number', `category_status`= '$cate_status' WHERE `category_id` = '$cate_id' ";
                   $mysql = $conn->query($updatSql);
                }
               
                    if($mysql == 'TRUE'){
                        redirect('showCate.php');
                    }else{
                        redirect('addCate.php');
                    }
        }
    }   
?>	
    <!-- Page Content -->
    <div id="page-wrapper"> 
        <div class="container" style="margin-top:100px;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel panel-warning ">
                        <div class="panel-heading">
                          Manage category
                        </div>
                        <div class="panel-body">
                            <form method = "post">
                                <fieldset id ="form_id">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label label_id">Cate Name</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "cate_name" class="form-control" placeholder="Please enter category name" required  value = "<?php echo $cate_name; ?>"><span id = "error_msg"><?php echo $msg;?></span>
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Order no</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "order_number" class="form-control" placeholder="Please enter order number" required value="<?php echo $order_number ;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Satus</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "category_status" class="form-control" placeholder="Please enter order number" required value = "<?php echo $cate_status; ?>">
                                        </div>
                                    </div>
                                   
                                    <input type = "submit" name = "submit" class="btn btn-lg btn-success">
                                    <p class="text-warning"></p>
                                </fieldset>
                            </form>
                        </div>
                        <div class="panel-footer">
                        Panel Footer
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>    
     
<?PHP include "adminFooter.php";?>   
