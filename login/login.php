<?php
	include "../common/dbconn.php";
	
	session_start();

	$id = $_POST['id'];
	$password = $_POST['password'];

	if($id!="" && $password!=""){
		$sql = "SELECT * FROM pt_member where mem_userid = '$id'";
		$result = mysqli_query($db_conn, $sql);
		$count = mysqli_num_rows($result);

		if($count != 1){
			echo("1");
		}else{
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			$db_passoword = $row["mem_password"];

			if($password != $db_passoword){
				echo("2");
				exit;
			}else{
				$_SESSION['userno'] = $row["mem_id"];
				$_SESSION['userid'] = $row["mem_userid"];
				$_SESSION['username'] = $row["mem_username"];
				$_SESSION['is_admin'] = $row["mem_is_admin"];
			
				echo("3");
			}
		}
	}else if($id!=""){
		echo("4");
	}else if($password!=""){
		echo("5");
	}else{
		echo("6");
	}

	mysqli_close($db_conn);
?>
