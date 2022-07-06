<?php include "adminHeader.php"; 
	 require '../dbConfig/dbConfig.php';?>
     <div id="page-wrapper"> 
        <?php 
     error_reporting(E_ALL);
    

     $msg = '';
     $name  = '';
     $number = '';
     $email = '';
     $password = '';
     $status = '';
    
        if(isset($_GET['user_id']) && $_GET['user_id'] > 0){
            $user_id = $_GET['user_id'];
            
            $updateSql = " select * from  `or_user_tbl` where `user_id` = '$user_id' ";
            $updateMySql = $conn->query($updateSql);
            $fetchSql = $updateMySql->fetch_assoc();
            $name = $fetchSql['user_name'];
            $number = $fetchSql['user_mobile'];
            $email = $fetchSql['user_email'];
            $password = $fetchSql['user_password'];
            $status = $fetchSql['user_status'];
           
        }     
            if(isset($_POST['submit'])){   
                $name = $conn->real_escape_string($_POST['user_name']);
                $number = $conn->real_escape_string($_POST['user_mobile']);
                $email = $conn->real_escape_string($_POST['user_email']);
                $password = $conn->real_escape_string($_POST['user_password']);
                $status = $conn->real_escape_string($_POST['user_status']);
                $add_on = date(`y-m-d h:i:s`);
                // $encriptPass = password_hash($password,PASSWORD_BCRYPT);

                if($user_id == ''){
                    $checkSql = "select * from  `or_user_tbl` where `user_email` = '$email'" ;
                }else{
                        $checkSql = "select * from  `or_user_tbl` where `user_email` = '$email' and  `user_id` != '$user_id'";  
                }
                    $checksql = $conn->query($checkSql);
                    if($checkBoy = $checksql->num_rows>0){
                       $msg = "Email Adress is already exist please check exist email id";
                    }else{
                     if($user_id == ''){
                          $sql = "INSERT INTO `or_user_tbl`(`user_name`, `user_mobile`, `user_email`, `user_password`, `user_status`, `add_on`) VALUES ('$name','$number','$email','$password','$status','$add_on')";
                             $mysql = $conn->query($sql);    
                        }else{
                         
                        $mysql = $conn->query("UPDATE `or_user_tbl` SET `user_name`= '$name',`user_mobile`= '$number',`user_email`= '$email',`user_password` ='$password',`user_status`= '$status' WHERE `user_id` = '$user_id'");
                        }
                        if($mysql){
                          redirect('showUser.php');
                        echo "submit";
                        }else{
                            echo "not submite";
                        }
                    }
            }    
?>



        <div class="container" style="margin-top:100px;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel panel-warning ">
                        <div class="panel-heading">
                      Add User
                        </div>
                        <div class="panel-body">
                            <form method = "post">
                                <fieldset id ="form_id">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label label_id">User Name
                                        </label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "user_name" class="form-control" placeholder="Please enter boys name" required  value = "<?php echo $name;?>">
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Mobile no</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "user_mobile" class="form-control" placeholder="Please enter mobile no" required value="<?php echo $number; ?>">
                                       
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">User Email</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "user_email" class="form-control" placeholder="Please enter boys email" required value = "<?php echo $email; ?>">  <span id ="error_msg"><?php echo $msg;?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">User Password</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "user_password" class="form-control" placeholder="Please enter boys email" required value = "<?php echo $password; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">User Status</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "user_status" class="form-control" placeholder="Please enter boys status" required value = "<?php echo $status; ?>">
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
