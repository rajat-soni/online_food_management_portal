<?php 
 	 session_start();
	 require '../dbConfig/dbConfig.php';
     require '../customFunction/function.php';
	 
	 	if(isset($_POST['submit'])){
     	    
			
			$cate_type = $conn->real_escape_string($_POST['cate_name']);
            $order_number = $conn->real_escape_string($_POST['order_number']);
			$cate_status = $conn->real_escape_string($_POST['category_status']);
			$add_on = date(`y-m-d h:i:s`);

			if($cate_type != 0 && $order_number != 0 && $cate_status != 0){
				 $checkSql = "select * from  `or_category_tbl` where `category_name` = '$cate_type' ";
				$checkMySql = $conn->query($checkSql) or die('error in sql table');
				if($check = $checkMySql->num_rows >0){?>
					<script>alert('category alery exist');</script>
				<?php }else{
				
						$cate_sql = " INSERT INTO `or_category_tbl`(`category_name`,`order_number`,`category_status`, `add_on`) VALUES ('$cate_type','$order_number','$cate_status','$add_on')";
							$mysql = $conn->query($cate_sql);
							if($mysql == 'TRUE'){
								redirect('showCate.php');
							}else{
								redirect('addCate.php');
							}
			    }
			}else {?>
			<script>alert('ileds should not be empty!');</script>
			<?Php redirect('addCate.php');}			
		}
		?>	