<?php
	include "../common/dbconn.php";

	session_start();

	$id = $_POST['id'];

	$sql = "SELECT * FROM pt_member where mem_userid = '$id'";
	$result = mysqli_query($db_conn, $sql);
	$count = mysqli_num_rows($result);

	if($count != 1){
		echo("1");
	}else{
		echo("0");
	}

	mysqli_close($db_conn);
?>