<?php
	// 데이터베이스 연결하기
	include "../common/dbconn.php";

	session_start();

	$board_no = $_GET["board_no"];
	$no = $_GET["no"];
	
	$query = "DELETE FROM pt_board WHERE board_no =$board_no";

	mysqli_query($db_conn, $query);
	mysqli_close($db_conn);
	
	echo("
		<script>
			location.href = '../admin/board_list.php?no=$no';
		</script>
	");
	

?>