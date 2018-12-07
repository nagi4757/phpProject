<?php
		// 데이터베이스 연결하기
		include "../common/dbconn.php";

		$content = mysqli_real_escape_string($db_conn, $_POST['content']);
		$board_title = mysqli_real_escape_string($db_conn, $_POST['board_title']);
		$board_service = mysqli_real_escape_string($db_conn, $_POST['board_service']);
		$board_no = mysqli_real_escape_string($db_conn, $_POST['board_no']);
	
		$query = "UPDATE pt_board ".
				 "SET ".
					"board_title='$board_title',
					board_content='$content',
					board_service_number=$board_service
				 WHERE board_no = $board_no";
	
		mysqli_query($db_conn, $query);
		mysqli_close($db_conn);
		
		echo("
			<script>
				location.href = 'board_list.php?';
			</script>
		");
?>