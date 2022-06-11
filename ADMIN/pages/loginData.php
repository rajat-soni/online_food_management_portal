<?php 
 	 session_start();
	 require '../dbConfig/dbConfig.php';
     require '../customFunction/function.php';
	 
	 if(isset($_POST['admin_email'])){
     	
			$email = $_POST['admin_email'];
			$password = $_POST['admin_password'];
            $data = array();
		
		  $cate_sql = " SELECT * FROM `admin_tbl` WHERE `admin_email` = '$email' and `admin_password` = '$password' ";
			$mysql = $conn->query($cate_sql) or die("Sql not executed");
			$check_user = $mysql->num_rows;
			if($check_user > 0){
				$loop = $mysql->fetch_assoc();
				$data = $loop;
				// print_r($data);
			
				$_SESSION['is_ADMIN_LOGIN'] = 'yes';
				$_SESSION['is_ADMIN_ID'] = $data['admin_id'];
				$_SESSION['ADMIN_NAME'] =  $data['admin_name'];
			
			
			redirect('adminIndex.php');
			
			}else{?>
				<script>
				alert("Please enter valid  login credentials");
			    window.location.href = 'login.php';
			</script>
			<?php	
			}
        }	


			