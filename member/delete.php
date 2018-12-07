<?php
	// 데이터베이스 연결하기
	include "../common/dbconn.php";
	session_start();

	$is_admin = $_SESSION['is_admin'];
	$mem_id = $_GET["mem_id"];
	
	$query = "DELETE FROM pt_member WHERE mem_id=$mem_id";

	mysqli_query($db_conn, $query);
	mysqli_close($db_conn);

	if($is_admin == 'Y'){
		$no = $_GET["no"];
		$mem_no = $_GET["mem_no"];
		echo("
			<script>
				location.href = '../admin/appointment_list?no=$no&mem_no=$mem_no';
			</script>
		");
	}else if($is_admin == 'N'){
		echo("
			<script>
				location.href = '../login/logout.php';
			</script>
		");
	}
?>