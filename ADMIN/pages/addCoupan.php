<?php include "adminHeader.php";
 include '../dbConfig/dbConfig.php';
 ?>
    <div id="page-wrapper"> 
        <h1 class="text-muted">Add/Manage Coupan Master</h1>
        <hr>
        
        <?php 
            error_reporting('E_ALL');
            $msg = '';
            $coupan_code = '';
            $coupan_type = '';
            $coupan_value = '';
            $cart_min_value = '';
            $expired_on = '';
            $coupan_status = '';
            $add_on = "";
            if(isset($_GET['coupan_id']) && $_GET['coupan_id'] > 0){
                $coupan_id = $_GET['coupan_id']; 
                print_r($coupan_id); 
                $updateSql = "select * from  `or_coupan_tbl` where `coupan_id` = '$coupan_id' ";
                $updateMySql = $conn->query($updateSql);
                $fetchSql = $updateMySql->fetch_assoc();
                $coupan_id = $fetchSql['coupan_id'];
                $coupan_code = $fetchSql['coupan_code'];
                $coupan_type = $fetchSql['coupan_type'];
                $coupan_value = $fetchSql['coupan_value'];  
                $cart_min_value = $fetchSql['cart_min_value'];
                $expired_date = $fetchSql['expired_date'];
                $coupan_status = $fetchSql['coupan_status'];
                $add_on =  date('Y-m-d');
               
            } 

            if(isset($_POST['submit'])){   
                $coupan_id = $conn->real_escape_string($_POST['coupan_id']); 
                $coupan_code = $conn->real_escape_string($_POST['coupan_code']);
                $coupan_type = $conn->real_escape_string($_POST['coupan_type']);
                $coupan_value = $conn->real_escape_string($_POST['coupan_value']);
                $cart_min_value = $conn->real_escape_string($_POST['cart_min_value']); 
                $expired_on = $conn->real_escape_string($_POST['expired_on']); 
                $coupan_status = $conn->real_escape_string($_POST['coupan_status']); 
                $add_on =  date('Y-m-d');  
                 print_r($_POST['coupan_id']); 
               
                     
                if(isset($_GET['coupan_id'])== ''){

                    $cpnSql = " SELECT * FROM  `or_coupan_tbl` WHERE `coupan_code` = '$coupan_code' ";
                        
                }else{ 

                   $cpnSql = " SELECT * FROM  `or_coupan_tbl` WHERE `coupan_code` = '$coupan_code' AND `coupan_id` != '$coupan_id' ";
                }
                $cpnsql = $conn->query($cpnSql) or die("coupan sql not executed");

                if($cpnsql->num_rows > 0){
                    $msg = "coupan alredy exist";
                }else{
                        if(isset($_GET['coupan_id']) == ''){
                            echo $sql = " INSERT INTO `or_coupan_tbl`(`coupan_code`,`coupan_type`, `coupan_value`, `cart_min_value`, `expired_on`,`coupan_status`) VALUES ('$coupan_code','$coupan_type','$coupan_value','$cart_min_value','$expired_on','$coupan_status') ";
                                $myCoupan = $conn->query($sql);  
                                
                        }else{
                            
                        echo $sql = "UPDATE `or_coupan_tbl` SET `coupan_code`= '$coupan_code',`coupan_type`= '$coupan_type',`coupan_value`= '$coupan_value',`cart_min_value` ='$cart_min_value', `expired_on` = '$expired_on', `coupan_status` = '$coupan_status' WHERE `coupan_id` = '$coupan_id'";
                                $myCoupan = $conn->query($sql);  
                                //die();      
                        } 
                
                        if($myCoupan){
                             redirect('showCoupan.php');
                        }else{
                             redirect('addCoupan.php');
                        }      
                }
            }
?>
        <div class="container" style="margin-top:50px; ">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel panel-warning ">
                        <div class="panel-heading">
                    Add/Manage Coupan 
                        </div>
                        <div class="panel-body">
                            <form method = "post" enctype="multipart/form-data">
                                <fieldset id ="form_id">
                                <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label label_id">coupan id
                                        </label>
                                        <div class="col-sm-10">   
                                        <input type= "hidden" name = "coupan_id" class="form-control" placeholder="Please enter coupan code" required value="<?php echo $coupan_id;?>"> 
                                        <span style="color:red; padding-top:10px;"><?php echo $msg;?></span>  
                                        </div>  
                                        
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label label_id">coupan code
                                        </label>
                                        <div class="col-sm-10">   
                                        <input type= "text" name = "coupan_code" class="form-control" placeholder="Please enter coupan code" required value="<?php echo $coupan_code;?>"> 
                                        <span style="color:red; padding-top:10px;"><?php echo $msg;?></span>  
                                        </div>  
                                        
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">coupan_type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="coupan_type">
                                                <option>Please select one</option>

                                                <?php  $arr = array("P"=>"Percentage","F"=>"Fixed");
                                                foreach($arr as $key=>$value){
                                                    
                                                    if($key == $coupan_type){
                                                        echo '<option value= "'.$key.'" selected>'.$value.'</option>';
                                                    }else{
                                                        echo '<option value= "'.$key.'">'.$value.'</option>';
                                                    }
                                                   
                                                }
                                                
                                                ?>

                                            </select>
                                     
                                       
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">coupan value</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "coupan_value" class="form-control" placeholder="Please enter coupan value" required value="<?php echo $coupan_value;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Cart min value</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "cart_min_value" class="form-control" placeholder="Please enter cart min value" required value="<?php echo $cart_min_value;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">expire on</label>
                                        <div class="col-sm-10">
                                        <input type = "date" name = "expired_on" class="form-control" placeholder="slect file" value = "<?php echo $expired_on;?>">
                                        <span><?php ?></span>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Dish Status</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name ="coupan_status" class="form-control" placeholder="Please enter dish status" required value = "<?php echo $coupan_status;?>">
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
