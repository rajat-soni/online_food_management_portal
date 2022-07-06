

<?php include "adminHeader.php"; 
	 require '../dbConfig/dbConfig.php';?>
    <div id="page-wrapper"> 
        <?php 
     error_reporting(E_ALL);
     $msg = '';
     $category_id  = '';
     $dish_name = '';
     $short = '';
     $dish_details = '';
     $filename = '';
     $status = '';
    
        if(isset($_GET['dish_id']) && $_GET['dish_id'] > 0){
            $dish_id = $_GET['dish_id'];
            
            $updateSql = "select * from  `or_dish_table` where `dish_id` = '$dish_id' ";
            $updateMySql = $conn->query($updateSql);
            $fetchSql = $updateMySql->fetch_assoc();
            $category_id = $fetchSql['category_id'];
            $dish_name = $fetchSql['dish_name'];
            $short = $fetchSql['dish_short_details'];
            $dish_details = $fetchSql['dish_details'];
            $filename = $fetchSql["dish_image"];
            print_r($filename);
            die;
            $status = $fetchSql['dish_status'];
           
        }   
          
            if(isset($_POST['submit'])){   
                $category_id = $conn->real_escape_string($_POST['category_id']);
                $dish_name = $conn->real_escape_string($_POST['dish_name']);
                $short = $conn->real_escape_string($_POST['dish_short_details']);
                $dish_details = $conn->real_escape_string($_POST['dish_details']);
                $filename = $_FILES["dish_image"]["name"];
                print_r($filename);
                $tempname = $_FILES["dish_image"]["tmp_name"];
                print_r($trmpname);
                $folder = "../images/" . $filename;
                print_r($folder);
                $status = $conn->real_escape_string($_POST['dish_status']);
                
                // $encriptPass = password_hash($password,PASSWORD_BCRYPT);
                move_uploaded_file($tempname,$folder);
                // $status = $conn->real_escape_string($_POST['dish_status']);
                    $add_on = date(`y-m-d h:i:s`);
                    if(isset($_GET['dish_id']) == ''){
                          $sql = " INSERT INTO `or_dish_table`(`category_id`, `dish_name`, `dish_short_details`, `dish_details`, `dish_image`, `dish_status`, `add_on`) VALUES ('$category_id','$dish_name','$short','$dish_details','$filename','$status','$add_on')";
                             $mysql = $conn->query($sql);
                
                        }else{

                            if($filename == ""){
                                echo $sql = "UPDATE `or_dish_table` SET `category_id`= '$category_id',`dish_name`= '$dish_name',`dish_short_details`= '$short',`dish_details` ='$dish_details',`dish_status` = '$status' WHERE `dish_id` = '$dish_id' ";
                                $mysql = $conn->query(sql);
                               
                            }else{
                                echo $sql = "UPDATE `or_dish_table` SET `category_id`= '$category_id',`dish_name`= '$dish_name',`dish_short_details`= '$short',`dish_details` ='$dish_details', `dish_image` = '$file_name', `dish_status` = '$status' WHERE `dish_id` = '$dish_id' ";
                                $mysql = $conn->query(sql);
                            }
                        }

                        if($mysql == 'TRUE'){
                         redirect('showDish.php');
                        
                       
                        }else{
                        redirect('addDish.php');
                           
                        }
                    }
                    
            $sql = "select * from  `or_category_tbl` ";
             $mysql = $conn->query($sql);
             if($check = $mysql->num_rows > 0){
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
                            <form method = "post" enctype="multipart/form-data">
                                <fieldset id ="form_id">
                                    <div class="form-group row">
                                       
                                        <label for="inputPassword" class="col-sm-2 col-form-label label_id">Category_id
                                        </label>
                                        <div class="col-sm-10">
                                       
                                            <select name = "category_id" class="form-control" value="<?php echo $category_id;?>">
                                                <option value = ""> Please Select one</option>
                                            <?php  while($result = $mysql->fetch_assoc()){?>
                                                <option value = "<?php echo $result['category_id'];?>"><?php echo $result['category_name'];?></option>
                                                <?php } } ?>
                                             </select>
                                            
                                       
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Dish_Name</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "dish_name" class="form-control" placeholder="Please enter Dish Name" required value="<?php echo $dish_name;?>">
                                       
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Short Discription</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "dish_short_details" class="form-control" placeholder="Please enter short discription" required value = "<?php echo $short;?> "><span id ="error_msg"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Dish Discription</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "dish_details" class="form-control" placeholder="Please enter dish discription" required value="<?php echo $dish_details;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Dish Image</label>
                                        <div class="col-sm-10">
                                        <input type= "file" name ="dish_image" placeholder="slect file" required value = "<?php echo $filename;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Dish Status</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "dish_status" class="form-control" placeholder="Please enter dish status" required value = "<?php echo $status;?>">
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