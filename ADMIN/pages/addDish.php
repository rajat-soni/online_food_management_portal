<?php include "adminHeader.php"; 
    require '../dbConfig/dbConfig.php';
 ?>
    <div id="page-wrapper"> 
        <?php 
            error_reporting(0);
            $msg = '';
            $category_id  = '';
            $dish_name = '';
            $short = '';
            $dish_details = '';
            $filename = '';
            $status = '';
            $dish_dish_id = '';
            $image_status = "required";
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
                $status = $fetchSql['dish_status'];
                $image_status = "";
                
            }    
         
            if(isset($_POST['submit'])){   
           
                $category_id = $conn->real_escape_string($_POST['category_id']);
                $dish_name = $conn->real_escape_string($_POST['dish_name']);
                $short = $conn->real_escape_string($_POST['dish_short_details']);
                $dish_details = $conn->real_escape_string($_POST['dish_details']);
                $status = $conn->real_escape_string($_POST['dish_status']);             
                $add_on = date(`y-m-d h:i:s`);
                
                if(isset($_GET['dish_id']) == ''){
                    $filename = $_FILES["dish_image"]["name"];
                    $tempname = $_FILES["dish_image"]["tmp_name"];
                    $size = $_FILES["dish_image"]["size"];
                    $type = $_FILES["dish_image"]["type"];
                    $folder = IMAGE_PATH.rand().$filename;             
                    if($type == "image/jpeg" || $type == "image/png"){
                        move_uploaded_file($tempname,$folder);
                       
                     

                        $sql = " INSERT INTO `or_dish_table`(`category_id`, `dish_name`, `dish_short_details`, `dish_details`, `dish_image`, `dish_status`, `add_on`) VALUES ('$category_id','$dish_name','$short','$dish_details','$filename','$status','$add_on')";
                        $mysql = $conn->query($sql);
                        $id = $conn->insert_id; 
                        // var_dump($id);
                        // get id for consider as forgien key in dish_Detail table //
                          // code block for dish_detail table //
                        $dish_detail_id = $_POST['dish_dish_id'];
                        print_r($dish_detal_id);
                        $attributeArry = $_POST['dish_attribute'];
                        $price = $_POST['price'];
                        foreach($attributeArry as $key=>$value){
                            $dish_attribute = $value;
                            $money = $price[$key]; 
                                if(isset($dish_detail_id[$key])){

                                     $conn->query ("UPDATE `or_dish_details_tbl` SET `dish_attribute`='dish_attribute',`price`= '$money' WHERE dish_detail_id = '$dish_detail_id'");
                                     echo "UPDATE `or_dish_details_tbl` SET `dish_attribute`='dish_attribute',`price`= '$money' WHERE dish_detail_id = '$dish_detail_id'";
                                }else{ 
                                    $mysql = $conn->query("INSERT INTO `or_dish_details_tbl`(`dish_dish_id`, `dish_attribute`,`price`,`add_on`) VALUES ('$id','$dish_attribute','$money','$add_on')");
                                    echo "INSERT INTO `or_dish_details_tbl`(`dish_dish_id`, `dish_attribute`,`price`,`add_on`) VALUES ('$id','$dish_attribute','$money','$add_on'";
                                }
                        }
                             // removing old image by php code in image folder //
                             
                              $oldImg = "select `dish_image` from  `or_dish_table` where `dish_id` = '$dish_id'";
                            $imgMysql = $conn->query($oldImg);
                            $oldImgResult = $imgMysql->fetch_assoc();
                            $oldImgRest = $oldImgResult['dish_image'];
                            unlink(IMAGE_PATH.$oldImgRest);
                            // end code //
                         
                        
                    }else{
                        $image_error = "invaild image formate";
                    }
                }else{
                        
                    if($filename !== ""){
                         $sql = " UPDATE `or_dish_table` SET `category_id`= '$category_id',`dish_name`= '$dish_name',`dish_short_details`= '$short',`dish_details` ='$dish_details', `dish_image` = '$filename', `dish_status` = '$status' WHERE `dish_id` = '$dish_id' ";
                        $mysql = $conn->query($sql);        
                            }else{
                                  $sql = " UPDATE `or_dish_table` SET `category_id`= '$category_id',`dish_name`= '$dish_name',`dish_short_details`= '$short',`dish_details` ='$dish_details',`dish_status` = '$status' WHERE `dish_id` = '$dish_id' ";
                                $mysql = $conn->query($sql);
                                
                            }
                        }
                    
                    if($mysql == 'TRUE'){
                          //redirect('showDish.php');
                    }else{
                         // redirect('addDish.php');
                        
                    }
            }
                $sql = "Select * from  `or_category_tbl`  where `category_status` = 1 order by category_name asc ";
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
                            <form method = "post" enctype="multipart/form-data" >
                                <fieldset id ="form_id">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label label_id">Category_id
                                        </label>
                                        <div class="col-sm-10">
                                            <select name = "category_id" class="form-control" value="<?php echo $category_id;?>">
                                                <option value = ""> Please Select one</option>
                                            <?php  while($result = $mysql->fetch_assoc()){ if($result['category_id'] == $category_id){?>
                                                <option value = "<?php echo $result['category_id'];?>" selected><?php echo $result['category_name'];?></option>
                                                <?php }else{ ?>
                                                    <option value = "<?php echo $result['category_id'];?>"><?php echo $result['category_name'];?></option>

                                                <?php } } }?>
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
                                        <input type= "file" name = "dish_image" placeholder="slect file" <?php echo $image_status;?>>
                                        <span><?php echo $image_error;?></span>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Dish Status</label>
                                        <div class="col-sm-10">
                                        <input type= "text" name = "dish_status" class="form-control" placeholder="Please enter dish status" required value = "<?php echo $status;?>">
                                        </div>
                                    </div>
                                   
                                    
                                    <?php   if(isset($_GET['dish_id'])){
                                        $id = $_GET['dish_id'];
                                  
                                         $query = "SELECT * FROM `or_dish_details_tbl` where `dish_dish_id` = '$id'";
                                        $mysql = $conn->query($query);
                                        while($row = $mysql->fetch_assoc()){?>
                                      
                                     
                                    
                                       
                                        <div class="col-sm-6">
                                            <input type= "text" name = "dish_attribute[]" class="form-control" placeholder="Please enter dish Attributes value" required value = "<?php echo $row['dish_attribute'];?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type= "text" name = "price[]" class="form-control" placeholder="Please enter dish Price here" required value = "<?php echo $row['price'];?>">
                                        </div>
                                        <input type= "hidden" name = "dish_detail_id" class="form-control" placeholder="Please enter dish Attributes value" required value = "<?php echo $row['dish_detail_id'];?>">
                                    </div>
                                    <div class="form-group row" style = "padding-top: 10px;" id = "box_id">
                                    <?php }
                                         ?>
                                    <?php } else { ?>
                                        <div class="form-group" style = "padding-top: 40px;" id="box_id">
                                            <div class="col-sm-6">
                                                <input type= "text" name = "dish_attribute[]" class="form-control" placeholder="Please enter dish Attributes value" required >
                                            </div>
                                            <div class="col-sm-6">
                                                <input type= "text" name = "price[]" class="form-control" placeholder="Please enter dish Price here" required >
                                            </div>
                                    <?php } ?>
                                        
                                    </div>
                                    </div>
                                    <button class="btn btn-lg btn-info" class="form-control" name ="submit">Submit</button>

                                    <!-- button type ="button" use for escaping submit fucntionality of form"-->
                                    <button  type = "button" class="btn btn-lg btn-warning" class="form-control" onclick = "add_more()">Add More</button>
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
        <input type ="hidden" value = "1" id = "add_more">
    </div>    
    
    <script>
       
     
     
        function add_more(){
            var add_more = $("#add_more").val();
            add_more++;
            $("#add_more").val(add_more); 
            var data = '<div class="form-group" style = "padding-top: 40px;" id="box'+add_more+'"><div class="col-md-6"><input type= "text" name = "dish_attribute[]" class="form-control" placeholder="Please enter dish status" required value = ""></div><div class="col-md-4"><input type= "text" name = "price[]" class="form-control" placeholder="Please enter dish status" required value = ""></div><div class="col-md-2"><button  type = "button" class="btn btn-md btn-danger" class="form-control" onclick = add_remove("'+add_more+'")>Remove</button></div></div>';
        $("#box_id").append(data);}

        function add_remove(id){
        $("#box"+id).remove();
        }
    
    </script>
<?PHP include "adminFooter.php";?>   
