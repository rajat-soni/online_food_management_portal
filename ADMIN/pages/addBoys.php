<?php include "adminHeader.php"; 
	 require '../dbConfig/dbConfig.php';
     error_reporting(E_ALL);

     $msg = '';
     $boy_name  = '';
     $boy_number = '';
     $boy_email = '';
     $boy_status = '';
        if(isset($_GET['boys_id']) && $_GET['boys_id'] > 0){
            $boy_id = $_GET['boys_id'];
            
            $updateSql = " select * from  `or_delivery_boy_tbl` where `de_boy_id` = '$boy_id' ";
            $updateMySql = $conn->query($updateSql);
            $fetchSql = $updateMySql->fetch_assoc();
            $boy_name = $fetchSql['boy_name'];
            $boy_number = $fetchSql['mobile'];
            $boy_email = $fetchSql['boy_email'];
            $boy_status = $fetchSql['boy_status'];
           
        }     
            if(isset($_POST['submit'])){   
                $boy_name = $conn->real_escape_string($_POST['boy_name']);
                $boy_number = $conn->real_escape_string($_POST['mobile']);
                $boy_email = $conn->real_escape_string($_POST['boy_email']);
                $boy_status = $conn->real_escape_string($_POST['boy_status']);
                $add_on = date(`y-m-d h:i:s`);

                if($boy_id == ''){
                    $checkSql = "select * from  `or_delivery_boy_tbl` where `mobile` = '$boy_number'" ;
                }else{
                        $checkSql = "select * from  `or_delivery_boy_tbl` where `mobile` = '$boy_number' and  `de_boy_id` != '$boy_id'";  
                }
                    $checkSql = $conn->query($checkSql);
                    if($checkBoy = $checkSql->num_rows>0){
                       $msg = "Mobile no is already exist please check exist mobile no";
                    }else{
                        if($boy_id == ''){
                            $mysql = $conn->query("INSERT INTO `or_delivery_boy_tbl`(`boy_name`, `mobile`, `boy_email`, `boy_status`) VALUES ('$boy_name','$boy_number','$boy_email','$boy_status')");    
                        }else{
                         $updateSql = "UPDATE `or_delivery_boy_tbl` SET `boy_name`= '$boy_name',`mobile`= '$boy_number',`boy_email`= '$boy_email',`boy_status`= '$boy_status' WHERE `de_boy_id` = '$boy_id'";
                         $mysql = $conn->query($updateSql);
                        }
                        if($mysql){
                            redirect('showBoys.php');
                        }else{
                            redirect('addBoys.php'); 
                        }
                    }
            } 
?>


<div id="page-wrapper"> 
        <div class="container" style="margin-top:100px;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel panel-warning ">
                        <div class="panel-heading">
                        Delivery Boy Form
                        </div>
                        <div class="panel-body">
                            <form method = "post">
                                <fieldset id ="form_id">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label label_id">Boy Name
                                        </label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "boy_name" class="form-control" placeholder="Please enter boys name" required  value = "<?php echo $boy_name;?>">
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Mobile no</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "mobile" class="form-control" placeholder="Please enter mobile no" required value="<?php echo $boy_number; ?>">
                                        <span id ="error_msg"><?php echo $msg;?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Boys   Email</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "boy_email" class="form-control" placeholder="Please enter boys email" required value = "<?php echo $boy_email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Boys Status</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "boy_status" class="form-control" placeholder="Please enter boys status" required value = "<?php echo $boy_status; ?>">
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
